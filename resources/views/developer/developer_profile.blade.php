@extends('developer.layout')
@section('content')

<style>
    :root {
        --primary: #4361ee;
        --primary-light: #eef2ff;
        --secondary: #3f37c9;
        --accent: #4895ef;
        --light: #f8f9fa;
        --dark: #1e293b;
        --dark-light: #64748b;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
    }
    
    .developer-dashboard {
        background: #f1f5f9;
        min-height: 100vh;
        padding: 2rem 0;
        font-family: 'Inter', sans-serif;
    }
    
    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        transform: translateY(-2px);
    }
    
    .card-header {
        background: white;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        color: var(--dark);
    }
    
    .profile-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: 2.5rem 2rem;
        text-align: center;
        position: relative;
        border-radius: 12px 12px 0 0;
    }
    
    .profile-completion {
        margin-bottom: 1.5rem;
    }
    
    .progress-container {
        position: relative;
        height: 8px;
        border-radius: 8px;
        background: rgba(255,255,255,0.2);
        overflow: hidden;
        margin-top: 0.75rem;
    }
    
    .progress-bar {
        height: 100%;
        border-radius: 8px;
        transition: width 0.6s ease;
        background: white;
    }
    
    .progress-text {
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        justify-content: space-between;
        color: white;
    }
    
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.025em;
    }
    
    .badge-premium {
        background: rgba(255,255,255,0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    .badge-not-premium {
        background: rgba(255,255,255,0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    .developer-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.75rem;
    }
    
    .developer-table th {
        background: var(--primary-light);
        color: var(--primary);
        font-weight: 600;
        padding: 1rem 1.25rem;
        text-align: left;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .developer-table td {
        background: white;
        padding: 1.25rem;
        vertical-align: middle;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .developer-table td:first-child {
        border-left: 1px solid rgba(0,0,0,0.05);
        border-radius: 8px 0 0 8px;
    }
    
    .developer-table td:last-child {
        border-right: 1px solid rgba(0,0,0,0.05);
        border-radius: 0 8px 8px 0;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        border: none;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    
    .btn-primary {
        background: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background: var(--secondary);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(67, 97, 238, 0.2), 0 2px 4px -1px rgba(67, 97, 238, 0.06);
    }
    
    .btn-success {
        background: var(--success);
        color: white;
    }
    
    .btn-success:hover {
        background: #0d9e6e;
        transform: translateY(-1px);
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
    }
    
    .btn-outline:hover {
        background: rgba(67, 97, 238, 0.05);
    }
    
    .btn-icon {
        width: 2.5rem;
        height: 2.5rem;
        padding: 0;
        border-radius: 50%;
    }
    
    .modal-profile {
        max-width: 900px;
    }
    
    .profile-banner {
        height: 180px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        position: relative;
        border-radius: 12px 12px 0 0;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        object-fit: cover;
        border: 4px solid white;
        position: absolute;
        bottom: -60px;
        left: 2rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .profile-tabs {
        margin-top: 4rem;
    }
    
    .nav-tabs {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .nav-tabs .nav-link {
        border: none;
        color: var(--dark-light);
        font-weight: 500;
        padding: 0.75rem 1.25rem;
        margin-right: 0.5rem;
        border-radius: 8px 8px 0 0;
        transition: all 0.2s ease;
    }
    
    .nav-tabs .nav-link:hover {
        color: var(--primary);
        background: rgba(67, 97, 238, 0.05);
    }
    
    .nav-tabs .nav-link.active {
        color: var(--primary);
        background: rgba(67, 97, 238, 0.1);
        border-bottom: 3px solid var(--primary);
    }
    
    .tab-content {
        padding: 1.5rem 0;
    }
    
    .detail-item {
        margin-bottom: 1.25rem;
    }
    
    .detail-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }
    
    .detail-value {
        color: var(--dark-light);
        font-size: 0.9375rem;
    }
    
    .skill-tag {
        display: inline-block;
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.8125rem;
        font-weight: 500;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-active {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }
    
    .status-inactive {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }
    
    .rating-badge {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }
    
    .breadcrumb {
        background: transparent;
        padding: 0;
    }
    
    .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }
    
    .breadcrumb-item.active {
        color: var(--dark-light);
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: var(--dark-light);
    }
    
    .alert {
        border-radius: 8px;
        border: none;
    }
    
    .alert-dismissible .close {
        padding: 0.75rem 1.25rem;
    }
    
    @media (max-width: 768px) {
        .profile-avatar {
            width: 80px;
            height: 80px;
            bottom: -40px;
        }
        
        .profile-tabs {
            margin-top: 3rem;
        }
        
        .developer-table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="developer-dashboard">
    <div class="container">
        <!-- Status Messages -->
        @if(Session::has('errmsg'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-dismissible fade show alert-{{ Session::get('message') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle mr-3" style="font-size: 1.25rem;"></i>
                        <div>
                            <strong>{{Session::get('errmsg')}}</strong>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('errmsg')}}
            </div>
        </div>
        @endif

        <!-- Breadcrumb -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile Details</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Profile Completion -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="profile-header">
                        <h4 class="mb-3">Welcome Back!</h4>
                        @foreach($developer_details as $k)
                        <div class="profile-completion">
                            <div class="progress-text">
                                <span>Profile Completion</span>
                                <span>{{ $k->profile_complete }}%</span>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar" 
                                     style="width: {{ $k->profile_complete }}%;">
                                </div>
                            </div>
                            
                            @if($k->profile_complete == 100)
                                @if($premium_profile_details == 1)
                                <div class="badge badge-premium mt-3">
                                    <i class="fas fa-crown mr-2"></i> Premium Account
                                </div>
                                @else
                                <div class="badge badge-not-premium mt-3">
                                    <i class="fas fa-crown mr-2"></i> Upgrade to Premium
                                    <a href="{{ route('why_premium_purchase') }}" class="btn btn-success btn-sm ml-3">
                                        Upgrade Now <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                                @endif
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Developer Details Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Your Profile Details</h5>
                        <a href="{{ route('developer_profile_update_details') }}" class="btn btn-outline btn-sm">
                            <i class="fas fa-edit mr-1"></i> Edit Profile
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="developer-table">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Details</th>
                                        <th>Projects</th>
                                        <th>Availability</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($details as $s)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                               
                                                @if($s->portfolio_image)
                                                    <img src="{{ asset('public/upload/portfolio/'.$s->portfolio_image ) }}" 
                                                        class="rounded-circle mr-3" 
                                                        width="40" 
                                                        height="40" 
                                                        alt="{{ $s->name }}"
                                                    >
                                                @else
                                                    <img src="{{ asset('public/upload/profile_image/1640871620.png') }}" 
                                                        class="rounded-circle mr-3" 
                                                        width="40" 
                                                        height="40" 
                                                        alt="{{ $s->name }}"
                                                    >
                                                @endif
                                               
                                                <div>
                                                    <strong>{{ $s->name }} {{ $s->last_name }}</strong>
                                                    <div class="text-muted small">{{ $s->heading }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted small">{{ $s->phone }}</div>
                                            <div class="text-primary small">{{ $s->email }}</div>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $s->developer_status == 'Active' ? 'active' : 'inactive' }}">
                                                {{ $s->developer_status }}
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#profileModal{{ $s->dev_id }}">
                                                <i class="fas fa-eye mr-1"></i> View
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{ route('developer_project') }}" class="btn btn-sm btn-outline">
                                                <i class="fas fa-project-diagram mr-1"></i> Projects
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline" data-toggle="modal"
                                                data-target="#availabilityModal{{ $s->dev_id }}">
                                                <i class="far fa-calendar-alt mr-1"></i> Set
                                            </button>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('developer_profile_update_details') }}">
                                                        <i class="fas fa-edit mr-2"></i> Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Detail Modal -->
@foreach($details as $s)
<div class="modal fade" id="profileModal{{ $s->dev_id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-profile modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Banner + Profile Header -->
            <div class="profile-banner">
                <img src="{{ asset('public/upload/developer/'.$s->image) }}" 
                     class="profile-avatar" 
                     alt="{{ $s->name }}">
                <button type="button" class="btn btn-sm btn-icon position-absolute" 
                        style="top: 1rem; right: 1rem; background: rgba(255,255,255,0.2); color: white;" 
                        data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Body -->
            <div class="modal-body pt-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">{{ $s->name }} {{ $s->last_name }}</h4>
                        <p class="text-muted mb-0">{{ $s->heading }}</p>
                        <div class="d-flex align-items-center mt-2">
                            <i class="fas fa-map-marker-alt mr-1 text-muted"></i>
                            <small class="text-muted mr-3">{{ $s->address }}</small>
                            <span class="rating-badge status-badge">
                                <i class="fas fa-star mr-1"></i> {{ $s->rating }} Rating
                            </span>
                        </div>
                    </div>
                    <div>
                        <span class="status-badge status-{{ $s->developer_status == 'Active' ? 'active' : 'inactive' }}">
                            {{ $s->developer_status }}
                        </span>
                    </div>
                </div>
                
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs profile-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#about{{ $s->dev_id }}">
                            <i class="fas fa-user mr-1"></i> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#skills{{ $s->dev_id }}">
                            <i class="fas fa-code mr-1"></i> Skills
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#resume{{ $s->dev_id }}">
                            <i class="fas fa-file-alt mr-1"></i> Resume
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#portfolio{{ $s->dev_id }}">
                            <i class="fas fa-briefcase mr-1"></i> Portfolio
                        </a>
                    </li>
                </ul>
                
                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- About Tab -->
                    <div class="tab-pane fade show active" id="about{{ $s->dev_id }}">
                        <div class="detail-item">
                            <div class="detail-label">About Me</div>
                            <div class="detail-value">{!! $s->description !!}</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Availability</div>
                                    <div class="detail-value">
                                        <i class="far fa-calendar-alt mr-1 text-muted"></i>
                                        {{ $s->available_start_date }} to {{ $s->available_end_date }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Total Hours</div>
                                    <div class="detail-value">
                                        <i class="far fa-clock mr-1 text-muted"></i>
                                        {{ $s->total_hours }} hours
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Rate</div>
                                    <div class="detail-value">
                                        <i class="fas fa-dollar-sign mr-1 text-muted"></i>
                                        ${{ $s->perhr }}/hr
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Education</div>
                                    <div class="detail-value">
                                        <i class="fas fa-graduation-cap mr-1 text-muted"></i>
                                        {{ $s->education }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Languages</div>
                                    <div class="detail-value">
                                        <i class="fas fa-language mr-1 text-muted"></i>
                                        {{ $s->language }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Status</div>
                                    <div class="detail-value">
                                        <span class="status-badge status-{{ $s->developer_status == 'Active' ? 'active' : 'inactive' }}">
                                            {{ $s->developer_status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="detail-item">
                                    <div class="detail-label">Completed Jobs</div>
                                    <div class="detail-value">{!! $s->completed_job !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Skills Tab -->
                    <div class="tab-pane fade" id="skills{{ $s->dev_id }}">
                        <div class="detail-item">
                            <div class="detail-label">Technical Skills</div>
                            <div class="detail-value">
                                @if($s->skills)
                                    @foreach(explode(',', $s->skills) as $skill)
                                        <span class="skill-tag">{{ trim($skill) }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No skills added</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Resume Tab -->
                    <div class="tab-pane fade" id="resume{{ $s->dev_id }}">
                        <div class="detail-item">
                            <div class="detail-label">Resume</div>
                            <div class="detail-value">
                                @if($s->resume)
                                <a href="{{ asset('public/upload/resume/'.$s->resume) }}" 
                                   target="_blank" class="btn btn-primary">
                                    <i class="fas fa-download mr-2"></i> Download Resume
                                </a>
                                @else
                                <span class="text-muted">No resume uploaded</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Portfolio Tab -->
                    <div class="tab-pane fade" id="portfolio{{ $s->dev_id }}">
                        <div class="detail-item">
                            <div class="detail-label">Portfolio</div>
                            <div class="detail-value">
                                @if($s->portfolio_image)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <img src="{{ asset('public/upload/portfolio/'.$s->portfolio_image) }}" 
                                                 class="card-img-top" alt="Portfolio Item">
                                            <div class="card-body">
                                                <h6 class="card-title">Project Sample</h6>
                                                <a href="{{ asset('public/upload/portfolio/'.$s->portfolio_image) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline">
                                                    <i class="fas fa-external-link-alt mr-1"></i> View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <span class="text-muted">No portfolio items uploaded</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
                <a href="{{ route('developer_profile_update_details') }}" class="btn btn-primary">
                    <i class="fas fa-edit mr-1"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Availability Modal -->
@foreach($details as $s)
<div class="modal fade" id="availabilityModal{{ $s->dev_id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Set Availability</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @foreach($developer_details as $k)
                @if($k->login_status == 0)
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Your account is not active. Please contact support.
                    </div>
                    <form method="post" action="{{ route('developer_available_date_update_error') }}">
                        @csrf
                        <input type="hidden" name="update" value="{{ $s->dev_id }}">
                        
                        <div class="form-group">
                            <label class="detail-label">Start Date</label>
                            <input type="date" name="available_start_date" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="detail-label">End Date</label>
                            <input type="date" name="available_end_date" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
                @else
                <form id="updateAvailableDateForm{{ $s->dev_id }}" method="post" 
                      action="{{ route('developer_available_date_update') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="update" value="{{ $s->dev_id }}">
                        
                        <div class="form-group">
                            <label class="detail-label">Start Date</label>
                            <input type="date" name="available_start_date" 
                                   id="available_start_date{{ $s->dev_id }}" 
                                   class="form-control" required>
                            <small class="text-danger" id="error_start_date{{ $s->dev_id }}"></small>
                        </div>
                        
                        <div class="form-group">
                            <label class="detail-label">End Date</label>
                            <input type="date" name="available_end_date" 
                                   id="available_end_date{{ $s->dev_id }}" 
                                   class="form-control" required>
                            <small class="text-danger" id="error_end_date{{ $s->dev_id }}"></small>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-calendar-check mr-1"></i> Update Availability
                        </button>
                    </div>
                </form>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endforeach

<script>
// Availability Form Validation
@foreach($details as $s)
document.getElementById("updateAvailableDateForm{{ $s->dev_id }}").addEventListener("submit", function(e) {
    const startDate = document.getElementById("available_start_date{{ $s->dev_id }}");
    const endDate = document.getElementById("available_end_date{{ $s->dev_id }}");
    const errorStart = document.getElementById("error_start_date{{ $s->dev_id }}");
    const errorEnd = document.getElementById("error_end_date{{ $s->dev_id }}");
    
    errorStart.textContent = "";
    errorEnd.textContent = "";
    let isValid = true;
    
    if (!startDate.value) {
        errorStart.textContent = "Start date is required";
        isValid = false;
    }
    
    if (!endDate.value) {
        errorEnd.textContent = "End date is required";
        isValid = false;
    }
    
    if (startDate.value && endDate.value && endDate.value < startDate.value) {
        errorEnd.textContent = "End date cannot be before start date";
        isValid = false;
    }
    
    if (!isValid) {
        e.preventDefault();
    }
});
@endforeach

// Toastr notifications
@if(Session::has('errmsg'))
toastr.{{ Session::get('message') }}('{{ Session::get("errmsg") }}');
@endif
</script>

@endsection