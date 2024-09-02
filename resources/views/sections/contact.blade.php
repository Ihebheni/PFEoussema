<section class="contact-form section" id="contactus">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="section-title">
                    <div class="divider mb-3"></div>
                    <h2>Contact Us</h2>
                    <p class="mt-3">Have questions or feedback? We'd love to hear from you! Fill out the form below and we'll get back to you as soon as possible.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center pb-5">
            <div class="col-lg-9 text-center">
                <form id="contact-form" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <input name="user_name" type="text" class="form-control" placeholder="Your Name" required>
                                <span class="text-danger" id="error-name"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <input name="user_email" type="email" class="form-control" placeholder="Email Address" required>
                                <span class="text-danger" id="error-email"></span>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <textarea name="user_message" class="form-control" rows="8" placeholder="Your Message" required></textarea>
                                <span class="text-danger" id="error-message"></span>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-main mt-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </div>
                    <div class="error" id="error" style="display:none;">Sorry, your message could not be sent. Please try again.</div>
                    <div class="success" id="success" style="display:none;">Message Sent Successfully!</div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('{{ route('contact.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.errors) {
                // Display SweetAlert for validation errors
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fix the errors below:',
                    footer: `<ul>
                        ${Object.values(data.errors).map(errors => errors.map(error => `<li>${error}</li>`).join('')).join('')}
                    </ul>`
                });
            } else {
                // Display SweetAlert for success
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your message has been sent successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    document.getElementById('contact-form').reset();
                });
            }
        })
        .catch(() => {
            // Display SweetAlert for general errors
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Sorry, something went wrong. Please try again later.'
            });
        });
    });
    </script>
