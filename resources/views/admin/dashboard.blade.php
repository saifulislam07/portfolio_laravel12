@extends('layouts.admin')

@section('page_title', 'Dashboard Overview')

@section('content')
<div class="mb-5" data-aos="fade-down">
    <h2 class="playfair fw-bold mb-1">Welcome back, {{ auth()->user()->name }}</h2>
    <p class="text-muted">Here is what's happening with your portfolio today.</p>
</div>

<!-- Stats Row -->
<div class="row g-4 mb-5">
    <!-- Existing Stats Cards -->
    <div class="col-md-3">
        <div class="card card-luxury border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-black text-white rounded p-3">
                    <i class="fas fa-project-diagram fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted small text-uppercase mb-1">Projects</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['total_projects'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-luxury border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-black text-white rounded p-3">
                    <i class="fas fa-envelope fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted small text-uppercase mb-1">Messages</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['total_messages'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-luxury border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-black text-white rounded p-3">
                    <i class="fas fa-tools fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted small text-uppercase mb-1">Skills</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['total_skills'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-luxury border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-black text-white rounded p-3">
                    <i class="fas fa-heart fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted small text-uppercase mb-1">Hobbies</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['total_hobbies'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Analytics Overview -->
<div class="row g-4 mb-5">
    <div class="col-md-8">
        <div class="card card-luxury border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="playfair mb-0">Visitor Trends</h4>
                <span class="badge bg-light text-dark border">Last 7 Days</span>
            </div>
            <canvas id="visitorChart" height="250"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-luxury border-0 shadow-sm p-4">
            <h4 class="playfair mb-4">Traffic Sources</h4>
            <canvas id="sourceChart" height="250"></canvas>
            <div class="mt-4 small text-muted">
                <div class="d-flex justify-content-between mb-1">
                    <span><i class="fas fa-circle text-dark me-2"></i> Direct</span>
                    <span>45%</span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span><i class="fas fa-circle text-secondary me-2"></i> Search</span>
                    <span>30%</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span><i class="fas fa-circle text-light border me-2"></i> Social</span>
                    <span>25%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Analytics Row -->
<div class="row g-4 mb-5">
    <!-- Top Countries -->
    <div class="col-md-4">
        <div class="card card-luxury border-0 shadow-sm p-4 h-100">
            <h4 class="playfair mb-4">Top Countries</h4>
            <div class="country-list">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <span class="fs-4 me-3">🇧🇩</span>
                        <div>
                            <div class="fw-bold small">Bangladesh</div>
                            <div class="progress mt-1" style="height: 4px; width: 100px;">
                                <div class="progress-bar bg-black" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                    <span class="small fw-bold">85%</span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <span class="fs-4 me-3">🇺🇸</span>
                        <div>
                            <div class="fw-bold small">United States</div>
                            <div class="progress mt-1" style="height: 4px; width: 100px;">
                                <div class="progress-bar bg-black" style="width: 10%"></div>
                            </div>
                        </div>
                    </div>
                    <span class="small fw-bold">10%</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="fs-4 me-3">🇯🇵</span>
                        <div>
                            <div class="fw-bold small">Japan</div>
                            <div class="progress mt-1" style="height: 4px; width: 100px;">
                                <div class="progress-bar bg-black" style="width: 5%"></div>
                            </div>
                        </div>
                    </div>
                    <span class="small fw-bold">5%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Pages Table -->
    <div class="col-md-8">
        <div class="card card-luxury border-0 shadow-sm p-4 h-100">
            <h4 class="playfair mb-4">Top Performing Pages</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr class="text-uppercase">
                            <th>Page URL</th>
                            <th class="text-center">Views</th>
                            <th class="text-end">Avg. Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>/</code> <span class="text-muted">(Home)</span></td>
                            <td class="text-center fw-bold">1,240</td>
                            <td class="text-end">2m 45s</td>
                        </tr>
                        <tr>
                            <td><code>/projects</code></td>
                            <td class="text-center fw-bold">850</td>
                            <td class="text-end">4m 12s</td>
                        </tr>
                        <tr>
                            <td><code>/about</code></td>
                            <td class="text-center fw-bold">420</td>
                            <td class="text-end">1m 58s</td>
                        </tr>
                        <tr>
                            <td><code>/contact</code></td>
                            <td class="text-center fw-bold">150</td>
                            <td class="text-end">0m 45s</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Messages -->
    <div class="col-md-8">
        <div class="card card-luxury border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="playfair mb-0">Recent Messages</h4>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-dark">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="small text-uppercase">
                            <th>Sender</th>
                            <th>Date</th>
                            <th class="text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_messages as $msg)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $msg->name }}</div>
                                <div class="small text-muted">{{ $msg->email }}</div>
                            </td>
                            <td class="small">{{ $msg->created_at->diffForHumans() }}</td>
                            <td class="text-end">
                                @if($msg->is_read)
                                    <span class="badge bg-light text-muted border">Read</span>
                                @else
                                    <span class="badge bg-black text-white">New</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">No messages yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-md-4">
        <div class="card card-luxury border-0 shadow-sm p-4 h-100">
            <h4 class="playfair mb-4">Quick Actions</h4>
            <div class="d-grid gap-3">
                <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-dark text-start p-3">
                    <i class="fas fa-plus me-2"></i> Add New Project
                </a>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-dark text-start p-3">
                    <i class="fas fa-user-edit me-2"></i> Update Profile Bio
                </a>
                <a href="{{ route('admin.hobbies.index') }}" class="btn btn-outline-dark text-start p-3">
                    <i class="fas fa-heart me-2"></i> Manage Hobbies
                </a>
                <a href="/" target="_blank" class="btn btn-black text-start p-3 mt-2">
                    <i class="fas fa-external-link-alt me-2"></i> View Website
                </a>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function() {
    // Visitor Chart
    const ctx = document.getElementById('visitorChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Visitors',
                data: [65, 59, 80, 81, 56, 55, 40],
                borderColor: '#000000',
                backgroundColor: 'rgba(0, 0, 0, 0.05)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Source Chart
    const sCtx = document.getElementById('sourceChart').getContext('2d');
    new Chart(sCtx, {
        type: 'doughnut',
        data: {
            labels: ['Direct', 'Search', 'Social'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#000000', '#6c757d', '#dee2e6'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            cutout: '70%'
        }
    });
});
</script>
@endpush
@endsection
