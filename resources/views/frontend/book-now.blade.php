@extends('frontend.master')

@section('content')
@include('frontend.partials.banner', [
    'title' => 'Book Now',
    'image' => $page->banner_image ?? asset('banner.jpg'),
])

<section class="reservation-section">
    <div class="container">
        <div class="section-title text-center">
            <h2>BOOK YOUR EVENT</h2>
            <p>Fill out the form below to make a reservation for your special event</p>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="reservation-card">
                    <h3 class="mb-4">Booking Now</h3>
                    <form class="php-email-form" method="POST" action="{{ route('booking.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="people" class="form-label">Number of People <span class="text-danger">*</span></label>
                                <select class="form-select @error('people') is-invalid @enderror" id="people" name="people" required>
                                    <option value="" selected disabled>Select</option>
                                    <option value="2">2 People</option>
                                    <option value="4">4 People</option>
                                    <option value="6">6 People</option>
                                    <option value="8">8 People</option>
                                    <option value="10">10+ People</option>
                                </select>
                                @error('people')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" required min="{{ date('Y-m-d') }}">
                                @error('date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                                <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time" required>
                                @error('time')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Additional Requirements</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4" placeholder="Any special requests or dietary requirements"></textarea>
                            @error('message')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="captcha-section mb-3 d-flex align-items-center gap-2">
                            <span id="captcha-question" class="fw-bold"></span>
                            <input type="number" id="captcha-answer" class="form-control" style="width: 120px;" placeholder="Answer" required>
                            <span id="captcha-error" class="text-danger d-none"></span>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit-btn">Book Your Event</button>
                        <div id="loading-text" class="alert alert-info d-none mt-2">Sending your booking...</div>
                        @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif
                    </form>

                    <div class="download-section mt-3">
                        <a href="{{ asset('RDT-Catering-Menu-v1.1.pdf') }}" class="download-btn" download><i class="fas fa-download"></i> Download Order Form</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="info-card">
                    @php
                        use Carbon\Carbon;

                        $now = Carbon::now(); // current time
                        $dayOfWeek = $now->format('l'); // get day name, e.g., Monday

                        // Event booking times
                        $start = Carbon::parse($company->event_booking_start); 
                        $end = Carbon::parse($company->event_booking_end);

                        // Default status
                        $status = 'closed';
                        $badgeClass = 'closed';

                        // Logic: Saturday always closed
                        if($dayOfWeek != 'Saturday') {
                            if($now->between($start, $end)) {
                                $status = 'Open';
                                $badgeClass = 'open';
                            }
                        }
                    @endphp

                    <div class="status-badge {{ $badgeClass }} mb-3">
                        <i class="bi {{ $badgeClass == 'open' ? 'bi-check-circle' : 'bi-x-circle' }}"></i> {{ $status }}
                    </div>

                    <div class="info-item">
                        <h4>Opening Time</h4>
                        <p>
                            <strong>Monday - Sunday</strong><br>
                            {{ \Carbon\Carbon::parse($company->breakfast_start)->format('g:i A') }} - {{ \Carbon\Carbon::parse($company->breakfast_end)->format('g:i A') }} (Morning Breakfast)<br>
                            {{ \Carbon\Carbon::parse($company->lunch_dinner_start)->format('g:i A') }} - {{ \Carbon\Carbon::parse($company->lunch_dinner_end)->format('g:i A') }} (Lunch - Dinner)
                        </p>
                    </div>
                    <div class="info-item">
                        <h4>Book Your Event Today!</h4>
                        <p>
                            {{ \Carbon\Carbon::parse($company->event_booking_start)->format('g:i A') }} - {{ \Carbon\Carbon::parse($company->event_booking_end)->format('g:i A') }} (Lunch)<br>
                            {{ \Carbon\Carbon::parse($company->event_booking2_start)->format('g:i A') }} - {{ \Carbon\Carbon::parse($company->event_booking2_end)->format('g:i A') }} (Lunch - Dinner)
                        </p>
                    </div>
                    <div class="contact-highlight">
                        <h5>Call Us Now</h5>
                        <p><a href="tel:{{ $company->phone1 }}" class="contact-highlight-link">{{ $company->phone1 }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
$(document).ready(function() {
    let num1 = Math.floor(Math.random() * 10) + 1;
    let num2 = Math.floor(Math.random() * 10) + 1;
    let correctAnswer = num1 + num2;

    $('#captcha-question').text(`What is ${num1} + ${num2}? *`);

    $('.php-email-form').on('submit', function(e) {
        let userAnswer = parseInt($('#captcha-answer').val());
        if (userAnswer !== correctAnswer) {
            e.preventDefault();
            $('#captcha-error').removeClass('d-none').text('Incorrect answer');
        } else {
            $('#captcha-error').addClass('d-none');
            $('#loading-text').removeClass('d-none');
            $(this).find('button[type="submit"]').prop('disabled', true).text('Sending...');
        }
    });
});
</script>
@endsection