@extends('admin.layouts.app')

@section('title', 'Add Configuration')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-plus-circle"></i></span>
        <div>
            <p class="eyebrow mb-1">System Settings</p>
            <h1 class="h3 mb-1">Add Configuration</h1>
            <p class="text-muted mb-0">Create a new website configuration.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.config') }}">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.config.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Configuration Key <span class="text-danger">*</span></label>
                    <input class="form-control @error('config_key') is-invalid @enderror" 
                           name="config_key" type="text" value="{{ old('config_key') }}" 
                           placeholder="e.g., web_name" required>
                    <small class="text-muted">Unique identifier (use lowercase and underscores)</small>
                    @error('config_key')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Label <span class="text-danger">*</span></label>
                    <input class="form-control @error('config_label') is-invalid @enderror" 
                           name="config_label" type="text" value="{{ old('config_label') }}" 
                           placeholder="Display label" required>
                    @error('config_label')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Group <span class="text-danger">*</span></label>
                    <select class="form-select @error('config_group') is-invalid @enderror" 
                            name="config_group" required>
                        @foreach($configGroups as $key => $label)
                            <option value="{{ $key }}" {{ old('config_group') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('config_group')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <select class="form-select @error('config_type') is-invalid @enderror" 
                            name="config_type" required>
                        @foreach($configTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('config_type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('config_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Placeholder</label>
                    <input class="form-control @error('config_placeholder') is-invalid @enderror" 
                           name="config_placeholder" type="text" value="{{ old('config_placeholder') }}" 
                           placeholder="Placeholder text">
                    @error('config_placeholder')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Help Text</label>
                    <input class="form-control @error('config_help') is-invalid @enderror" 
                           name="config_help" type="text" value="{{ old('config_help') }}" 
                           placeholder="Help text for admin">
                    @error('config_help')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Default Value</label>
                    <input class="form-control @error('config_value') is-invalid @enderror" 
                           name="config_value" type="text" value="{{ old('config_value') }}" 
                           placeholder="Default value">
                    @error('config_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Required</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_required" value="1">
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Editable</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_editable" value="1" checked>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input class="form-control @error('sort_order') is-invalid @enderror" 
                           name="sort_order" type="number" value="{{ old('sort_order', 0) }}">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Options (JSON)</label>
                    <textarea class="form-control @error('config_options') is-invalid @enderror" 
                              name="config_options" rows="3" 
                              placeholder='{"default": "value", "options": ["Option 1", "Option 2"]}'>{{ old('config_options') }}</textarea>
                    <small class="text-muted">JSON format for select/radio options</small>
                    @error('config_options')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Create Configuration
                </button>
                <a href="{{ route('admin.config') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection