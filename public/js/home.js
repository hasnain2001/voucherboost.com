            // Handle the "Reveal Code" button click
            function handleRevealCode(couponId, couponCode, couponName, storeImage, destinationUrl, storeName) {
                // Show the modal with the coupon code
                document.getElementById('couponCode').textContent = couponCode;
                document.getElementById('couponName').textContent = couponName;
                document.getElementById('storeImage').src = storeImage;
                document.getElementById('couponUrl').href = destinationUrl;
                document.getElementById('couponUrl').textContent = storeName;

                // Update the click count via AJAX
                updateClickCount(couponId);

                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('couponModal'));
                modal.show();
            }

            // Function to update the click count via AJAX
            function updateClickCount(couponId) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route("update.clicks") }}', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                // Update the "Used By" count on the page
                                const usedCountElement = document.getElementById('usedCount' + couponId);
                                usedCountElement.textContent = `Used By: ${response.clicks}`;
                            }
                        } catch (error) {
                            console.error('Error parsing response:', error);
                        }
                    }
                };

                xhr.send('coupon_id=' + couponId);
            }

            // Copy the coupon code to the clipboard and show a success message
            function copyToClipboard() {
                const code = document.getElementById('couponCode').textContent;
                navigator.clipboard.writeText(code).then(() => {
                    const copyMessage = document.getElementById('copyMessage');
                    copyMessage.style.display = 'block';
                    setTimeout(() => {
                        copyMessage.style.display = 'none';
                    }, 3000); // Hide the message after 3 seconds
                });
            }

        $(document).ready(function() {
            $('#searchInput').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route("search") }}',
                        dataType: 'json',
                        data: { query: request.term
                        },
                        success: function(data) {
                            response(data.stores); // Ensure `data.stores` is an array of strings or objects
                        }
                    });
                },
                minLength: 1 // Minimum characters to trigger autocomplete
            });
        });

            // Get the button:
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
        // Function to toggle mobile nav
        function toggleMobileNav() {
            const mobileNav = document.getElementById('mobileNav');
            mobileNav.classList.toggle('active');
        }
