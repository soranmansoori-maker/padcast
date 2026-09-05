<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\Category;
use App\Models\Podcast;
use App\Models\User;
use App\Models\UserActivity;
use App\Services\RecommendationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecommendationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_recommends_albums_from_the_same_category_as_recent_user_activity()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('secret'),
            'role' => 'user',
            'status' => '1',
        ]);

        $musicCategory = Category::create([
            'name' => 'Music',
            'description' => 'Music category',
            'cover' => 'cover.jpg',
        ]);

        $techCategory = Category::create([
            'name' => 'Technology',
            'description' => 'Tech category',
            'cover' => 'tech.jpg',
        ]);

        $likedAlbum = Album::create([
            'title' => 'Liked album',
            'description' => 'Already liked album',
            'category' => $musicCategory->id,
            'cover' => 'liked.jpg',
            'user' => $user->id,
        ]);

        $recommendedAlbum = Album::create([
            'title' => 'Recommended album',
            'description' => 'Should be recommended',
            'category' => $musicCategory->id,
            'cover' => 'recommended.jpg',
            'user' => $user->id,
        ]);

        $otherAlbum = Album::create([
            'title' => 'Other album',
            'description' => 'Wrong category',
            'category' => $techCategory->id,
            'cover' => 'other.jpg',
            'user' => $user->id,
        ]);

        UserActivity::record($user, 'album', $likedAlbum->id, 'like');

        $service = app(RecommendationService::class);
        $recommendations = $service->forUser($user);

        $albumIds = collect($recommendations['albums'])->pluck('id')->all();

        $this->assertContains($recommendedAlbum->id, $albumIds);
        $this->assertNotContains($likedAlbum->id, $albumIds);
        $this->assertNotContains($otherAlbum->id, $albumIds);
    }

    public function test_it_falls_back_to_popular_items_when_user_has_no_activity()
    {
        $user = User::create([
            'name' => 'Anonymous User',
            'email' => 'anonymous@example.com',
            'password' => bcrypt('secret'),
            'role' => 'user',
            'status' => '1',
        ]);

        $category = Category::create([
            'name' => 'News',
            'description' => 'News category',
            'cover' => 'news.jpg',
        ]);

        $popularAlbum = Album::create([
            'title' => 'Popular album',
            'description' => 'Trending album',
            'category' => $category->id,
            'cover' => 'popular.jpg',
            'user' => $user->id,
            'view_count' => 20,
        ]);

        $popularPodcast = Podcast::create([
            'name' => 'Popular podcast',
            'description' => 'Trending podcast',
            'album' => $popularAlbum->id,
            'cover' => 'podcast.jpg',
            'file' => 'podcast.mp3',
            'status' => '1',
            'user' => $user->id,
        ]);

        $service = app(RecommendationService::class);
        $recommendations = $service->forUser($user);

        $this->assertNotEmpty($recommendations['albums']);
        $this->assertNotEmpty($recommendations['podcasts']);
        $this->assertContains($popularAlbum->id, collect($recommendations['albums'])->pluck('id')->all());
        $this->assertContains($popularPodcast->id, collect($recommendations['podcasts'])->pluck('id')->all());
    }

    public function test_it_recommends_from_the_same_category_as_a_recently_liked_podcast()
    {
        $user = User::create([
            'name' => 'Podcast Liker',
            'email' => 'liker@example.com',
            'password' => bcrypt('secret'),
            'role' => 'user',
            'status' => '1',
        ]);

        $musicCategory = Category::create([
            'name' => 'Music',
            'description' => 'Music category',
            'cover' => 'cover.jpg',
        ]);

        $techCategory = Category::create([
            'name' => 'Technology',
            'description' => 'Tech category',
            'cover' => 'tech.jpg',
        ]);

        $likedAlbum = Album::create([
            'title' => 'Liked podcast album',
            'description' => 'Album of the liked podcast',
            'category' => $musicCategory->id,
            'cover' => 'liked.jpg',
            'user' => $user->id,
        ]);

        $likedPodcast = Podcast::create([
            'name' => 'Liked podcast',
            'description' => 'A podcast the user liked',
            'album' => $likedAlbum->id,
            'cover' => 'podcast.jpg',
            'file' => 'podcast.mp3',
            'status' => '1',
            'user' => $user->id,
        ]);

        $recommendedAlbum = Album::create([
            'title' => 'Recommended music album',
            'description' => 'Should be recommended',
            'category' => $musicCategory->id,
            'cover' => 'recommended.jpg',
            'user' => $user->id,
            'view_count' => 10,
        ]);

        $otherAlbum = Album::create([
            'title' => 'Unrelated tech album',
            'description' => 'Wrong category',
            'category' => $techCategory->id,
            'cover' => 'other.jpg',
            'user' => $user->id,
        ]);

        UserActivity::record($user, 'podcast', $likedPodcast->id, 'like');

        $service = app(RecommendationService::class);
        $recommendations = $service->forUser($user);

        $albumIds = collect($recommendations['albums'])->pluck('id')->all();

        $this->assertContains($recommendedAlbum->id, $albumIds);
        $this->assertNotContains($otherAlbum->id, $albumIds);
    }
}
