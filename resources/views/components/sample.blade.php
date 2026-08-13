@extends('layouts.dashboard', [
    'activeNav' => 'feedback',
    'headerTitle' => 'Feedback',
    'headerSubtitle' => 'Browse and review visitor feedback submissions.',
    'profile' => $profile,
])

@section('title', 'Feedback — Cagayan Museum')

@section('content')
    <div class="space-y-6">
        <section class="feedback-panel" aria-labelledby="feedback-filters-heading">
            <div class="feedback-panel__header">
                <div>
                    <h2 id="feedback-filters-heading" class="feedback-panel__title">Search &amp; Filter</h2>
                    <p class="feedback-panel__subtitle">Find feedback by visitor name, comments, or rating.</p>
                </div>
            </div>

            <form method="GET" action="{{ route('dashboard.feedback') }}" class="feedback-filters">
                <div class="feedback-filters__field feedback-filters__field--grow">
                    <label for="search" class="feedback-label">Search</label>
                    <div class="feedback-search">
                        <x-lucide-icon name="search" class="feedback-search__icon h-4 w-4" />
                        <input id="search" type="search" name="search" value="{{ $filters['search'] }}"
                            placeholder="Name, comments, or location details"
                            class="feedback-input feedback-search__input">
                    </div>
                </div>

                <div class="feedback-filters__field">
                    <label for="experience" class="feedback-label">Experience</label>
                    <select id="experience" name="experience" class="feedback-select">
                        <option value="">All ratings</option>
                        @foreach (\App\Models\Feedback::overallExperiences() as $experience)
                            <option value="{{ $experience }}" @selected($filters['experience'] === $experience)>
                                {{ \App\Models\Feedback::experienceLabels()[$experience] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="feedback-filters__actions">
                    <button type="submit" class="feedback-btn feedback-btn--primary">
                        Apply
                    </button>
                    @if ($filters['search'] !== '' || $filters['experience'] !== '')
                        <a href="{{ route('dashboard.feedback') }}" class="feedback-btn feedback-btn--ghost">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </section>

        <section class="feedback-panel" aria-labelledby="feedback-list-heading">
            <div class="feedback-panel__header feedback-panel__header--row">
                <div>
                    <h2 id="feedback-list-heading" class="feedback-panel__title">Visitor Feedback</h2>
                    <p class="feedback-panel__subtitle">
                        @if ($feedbacks->total() === 0)
                            No entries found.
                        @elseif ($feedbacks->total() === 1)
                            1 submission
                        @else
                            {{ number_format($feedbacks->total()) }} submissions
                        @endif
                    </p>
                </div>

                @if ($feedbacks->total() > 0)
                    <p class="feedback-panel__meta">
                        Showing {{ $feedbacks->firstItem() }}–{{ $feedbacks->lastItem() }}
                    </p>
                @endif
            </div>

            @if ($feedbacks->isEmpty())
                <div class="feedback-empty">
                    <div class="feedback-empty__icon" aria-hidden="true">
                        <x-lucide-icon name="message-square" class="h-6 w-6" />
                    </div>
                    <h3 class="feedback-empty__title">No feedback yet</h3>
                    <p class="feedback-empty__text">
                        @if ($filters['search'] !== '' || $filters['experience'] !== '')
                            Try adjusting your search or filters to find matching submissions.
                        @else
                            Visitor submissions will appear here once the public feedback form is used.
                        @endif
                    </p>
                </div>
            @else
                <div class="feedback-table-wrap" x-data="{ openId: null }">
                    <table class="feedback-table">
                        <thead>
                            <tr>
                                <th scope="col">Visitor</th>
                                <th scope="col">Visit Date</th>
                                <th scope="col">Experience</th>
                                <th scope="col" class="hidden lg:table-cell">Demographics</th>
                                <th scope="col" class="hidden md:table-cell">Comments</th>
                                <th scope="col">Submitted</th>
                                <th scope="col"><span class="sr-only">Details</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr :class="{ 'feedback-table__row--open': openId === {{ $feedback->id }} }">
                                    <td>
                                        <div class="feedback-table__visitor">
                                            <span class="feedback-table__name">{{ $feedback->visitorName() }}</span>
                                            @if ($feedback->residenceLabel())
                                                <span class="feedback-table__meta hidden sm:inline">
                                                    {{ $feedback->residenceLabel() }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="feedback-table__date">
                                        {{ $feedback->visit_date?->format('M j, Y') ?? '—' }}
                                    </td>
                                    <td>
                                        @if ($feedback->overall_experience)
                                            <x-experience-badge :experience="$feedback->overall_experience" />
                                        @else
                                            <span class="feedback-badge feedback-badge--muted">Not rated</span>
                                        @endif
                                    </td>
                                    <td class="hidden lg:table-cell">
                                        <div class="feedback-table__demographics">
                                            @if ($feedback->ageRangeLabel())
                                                <span>{{ $feedback->ageRangeLabel() }}</span>
                                            @endif
                                            @if ($feedback->genderLabel())
                                                <span>{{ $feedback->genderLabel() }}</span>
                                            @endif
                                            @if (! $feedback->ageRangeLabel() && ! $feedback->genderLabel())
                                                <span class="text-neutral-400">—</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="hidden md:table-cell">
                                        @if (filled($feedback->comments))
                                            <p class="feedback-table__comment">
                                                {{ \Illuminate\Support\Str::limit($feedback->comments, 80) }}
                                            </p>
                                        @else
                                            <span class="text-neutral-400">No comments</span>
                                        @endif
                                    </td>
                                    <td class="feedback-table__date">
                                        {{ $feedback->created_at?->format('M j, Y') ?? '—' }}
                                    </td>
                                    <td class="feedback-table__actions">
                                        <button type="button" class="feedback-table__toggle"
                                            @click="openId = openId === {{ $feedback->id }} ? null : {{ $feedback->id }}"
                                            :aria-expanded="openId === {{ $feedback->id }}">
                                            <span class="sr-only">View details</span>
                                            <x-lucide-icon name="chevron-down" class="h-4 w-4"
                                                ::class="{ 'rotate-180': openId === {{ $feedback->id }} }" />
                                        </button>
                                    </td>
                                </tr>
                                <tr x-show="openId === {{ $feedback->id }}" x-cloak class="feedback-table__detail-row">
                                    <td colspan="7">
                                        <div class="feedback-detail">
                                            <dl class="feedback-detail__grid">
                                                <div class="feedback-detail__item">
                                                    <dt>Visitor</dt>
                                                    <dd>{{ $feedback->visitorName() }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Visit Date</dt>
                                                    <dd>{{ $feedback->visit_date?->format('F j, Y') ?? 'Not provided' }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Experience</dt>
                                                    <dd>
                                                        @if ($feedback->overall_experience)
                                                            <x-experience-badge :experience="$feedback->overall_experience" />
                                                            @if ($feedback->experienceScore())
                                                                <span class="feedback-detail__score">
                                                                    ({{ $feedback->experienceScore() }}/5)
                                                                </span>
                                                            @endif
                                                        @else
                                                            Not rated
                                                        @endif
                                                    </dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Age Range</dt>
                                                    <dd>{{ $feedback->ageRangeLabel() ?? 'Not provided' }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Gender</dt>
                                                    <dd>{{ $feedback->genderLabel() ?? 'Not provided' }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Residence</dt>
                                                    <dd>{{ $feedback->residenceLabel() ?? 'Not provided' }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Submitted</dt>
                                                    <dd>{{ $feedback->created_at?->format('F j, Y g:i A') ?? '—' }}</dd>
                                                </div>
                                            </dl>

                                            <div class="feedback-detail__comments">
                                                <h4 class="feedback-detail__comments-title">Comments</h4>
                                                @if (filled($feedback->comments))
                                                    <p class="feedback-detail__comments-body">{{ $feedback->comments }}</p>
                                                @else
                                                    <p class="feedback-detail__comments-empty">No comments provided.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($feedbacks->hasPages())
                    <div class="feedback-pagination">
                        {{ $feedbacks->links() }}
                    </div>
                @endif
            @endif
        </section>
    </div>
@endsection
