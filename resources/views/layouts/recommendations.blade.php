@extends('layouts.default')

@section('title')
    پیشنهادهای مخصوص شما
@stop

@section('main')
    <section class="spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>پیشنهادهای مخصوص شما</h3>
                    <hr>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-6">
                    <h4>آلبوم‌های پیشنهادی</h4>
                    @forelse($recommendations['albums'] as $album)
                        <div class="mb-3 p-3 border rounded">
                            <a href="/album/{{ $album->id }}">{{ $album->title }}</a>
                            <div class="small text-muted">
                                {{ $album->Category ? $album->Category->name : 'بدون دسته‌بندی' }}
                            </div>
                        </div>
                    @empty
                        <p>هیچ آلبومی برای پیشنهاد وجود ندارد.</p>
                    @endforelse
                </div>

                <div class="col-lg-6">
                    <h4>موسیقی‌های پیشنهادی</h4>
                    @forelse($recommendations['podcasts'] as $podcast)
                        <div class="mb-3 p-3 border rounded">
                            <a href="/album/{{ $podcast->Album->id }}#Podcast-{{ $podcast->id }}">
                                {{ $podcast->name }}
                            </a>
                            <div class="small text-muted">
                                {{ $podcast->Album && $podcast->Album->Category ? $podcast->Album->Category->name : 'بدون دسته‌بندی' }}
                            </div>
                        </div>
                    @empty
                        <p>هیچ موسیقی پیشنهادی وجود ندارد.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@stop
