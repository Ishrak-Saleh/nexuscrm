@extends('layouts.app')

@section('title', 'Edit Client')

@section('content')
    <div class="card-header">
        <h1 class="card-title">Edit Client: {{ $client->name }}</h1>
        <a href="{{ route('clients.show', $client) }}" class="btn btn-outline">
            Back to Client
        </a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('clients.update', $client) }}">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div>
                    <div class="form-group">
                        <label class="form-label" for="name">Full Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $client->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $client->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone Number</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               value="{{ old('phone', $client->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="company">Company</label>
                        <input type="text" 
                               id="company" 
                               name="company" 
                               class="form-control @error('company') is-invalid @enderror" 
                               value="{{ old('company', $client->company) }}">
                        @error('company')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Right Column -->
                <div>
                    <div class="form-group">
                        <label class="form-label" for="address">Address</label>
                        <textarea id="address" 
                                  name="address" 
                                  class="form-control @error('address') is-invalid @enderror" 
                                  rows="3">{{ old('address', $client->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="status">Status *</label>
                        <select id="status" 
                                name="status" 
                                class="form-control @error('status') is-invalid @enderror" 
                                required>
                            <option value="">Select Status</option>
                            <option value="lead" {{ old('status', $client->status) == 'lead' ? 'selected' : '' }}>Lead</option>
                            <option value="active" {{ old('status', $client->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $client->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="next_follow_up">Next Follow-up Date</label>
                        <input type="date" 
                               id="next_follow_up" 
                               name="next_follow_up" 
                               class="form-control @error('next_follow_up') is-invalid @enderror" 
                               value="{{ old('next_follow_up', $client->next_follow_up ? $client->next_follow_up->format('Y-m-d') : '') }}">
                        @error('next_follow_up')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('clients.show', $client) }}" class="btn btn-outline">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16L21 8V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 21V13H7V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 3V8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Update Client
                </button>
            </div>
        </form>
    </div>
@endsection