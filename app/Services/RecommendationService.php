<?php

namespace App\Services;

use App\Models\Album;
use App\Models\Podcast;
use App\Models\User;
use App\Models\UserActivity;

class RecommendationService
{
    public function forUser(User $user, int $limit = 6): array
    {
        $categoryIds = $this->getPreferredCategoryIds($user);

        $interactedAlbumIds = UserActivity::forUser($user)
            ->where('subject_type', 'album')
            ->pluck('subject_id')
            ->all();

        $interactedPodcastIds = UserActivity::forUser($user)
            ->where('subject_type', 'podcast')
            ->pluck('subject_id')
            ->all();

        if (empty($categoryIds)) {
            return [
                'albums' => $this->popularAlbums($limit),
                'podcasts' => $this->popularPodcasts($limit),
            ];
        }

        $albums = Album::with('Category')
            ->whereIn('category', array_unique($categoryIds))
            ->whereNotIn('id', $interactedAlbumIds)
            ->orderByDesc('view_count')
            ->limit($limit)
            ->get();

        $podcasts = Podcast::with('Album.Category')
            ->whereHas('album', function ($query) use ($categoryIds) {
                $query->whereIn('category', array_unique($categoryIds));
            })
            ->whereNotIn('id', $interactedPodcastIds)
            ->orderByDesc('download_count')
            ->limit($limit)
            ->get();

        if ($albums->isEmpty() && $podcasts->isEmpty()) {
            return [
                'albums' => $this->popularAlbums($limit),
                'podcasts' => $this->popularPodcasts($limit),
            ];
        }

        $recommendedAlbums = $albums->all();
        if (count($recommendedAlbums) < $limit) {
            $fallbackAlbums = $this->popularAlbums($limit, $interactedAlbumIds, $categoryIds);
            foreach ($fallbackAlbums as $album) {
                if (! in_array($album->id, array_map(fn ($item) => $item->id, $recommendedAlbums), true)) {
                    $recommendedAlbums[] = $album;
                }

                if (count($recommendedAlbums) >= $limit) {
                    break;
                }
            }
        }

        $recommendedPodcasts = $podcasts->all();
        if (count($recommendedPodcasts) < $limit) {
            $fallbackPodcasts = $this->popularPodcasts($limit, $interactedPodcastIds, $categoryIds);
            foreach ($fallbackPodcasts as $podcast) {
                if (! in_array($podcast->id, array_map(fn ($item) => $item->id, $recommendedPodcasts), true)) {
                    $recommendedPodcasts[] = $podcast;
                }

                if (count($recommendedPodcasts) >= $limit) {
                    break;
                }
            }
        }

        return [
            'albums' => array_values(array_slice($recommendedAlbums, 0, $limit)),
            'podcasts' => array_values(array_slice($recommendedPodcasts, 0, $limit)),
        ];
    }

    protected function getPreferredCategoryIds(User $user): array
    {
        $activity = UserActivity::forUser($user)
            ->latest('created_at')
            ->take(30)
            ->get();

        $categoryIds = [];

        foreach ($activity as $item) {
            if ($item->subject_type === 'album') {
                $album = Album::find($item->subject_id);

                if ($album) {
                    $categoryIds[] = $album->category;
                }

                continue;
            }

            if ($item->subject_type === 'podcast') {
                $podcast = Podcast::with('Album')->find($item->subject_id);

                if ($podcast && $podcast->Album) {
                    $categoryIds[] = $podcast->Album->category;
                }
            }
        }

        return array_values(array_unique(array_filter($categoryIds)));
    }

    protected function popularAlbums(int $limit, array $excludedIds = [], array $preferredCategories = []): array
    {
        $query = Album::with('Category')
            ->orderByDesc('view_count');

        if (! empty($excludedIds)) {
            $query->whereNotIn('id', $excludedIds);
        }

        if (! empty($preferredCategories)) {
            $query->whereIn('category', array_values(array_unique($preferredCategories)));
        }

        return $query->limit($limit)
            ->get()
            ->all();
    }

    protected function popularPodcasts(int $limit, array $excludedIds = [], array $preferredCategories = []): array
    {
        $query = Podcast::with('Album.Category')
            ->orderByDesc('download_count');

        if (! empty($excludedIds)) {
            $query->whereNotIn('id', $excludedIds);
        }

        if (! empty($preferredCategories)) {
            $query->whereHas('album', function ($q) use ($preferredCategories) {
                $q->whereIn('category', array_values(array_unique($preferredCategories)));
            });
        }

        return $query->limit($limit)
            ->get()
            ->all();
    }
}
