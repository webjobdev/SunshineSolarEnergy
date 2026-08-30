@push('scripts')
<script>
    // FAQ Filter Functionality
    $(document).ready(function() {
        $('.filter-btn').on('click', function() {
            var filter = $(this).data('filter');
            
            // Update active state
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');
            
            // Show/Hide FAQ items
            if (filter === 'all') {
                $('.accordion-item').show();
                $('.no-faq-results').hide();
            } else {
                var visible = 0;
                $('.accordion-item').each(function() {
                    if ($(this).data('category') === filter) {
                        $(this).show();
                        visible++;
                    } else {
                        $(this).hide();
                    }
                });
                
                if (visible === 0) {
                    $('.no-faq-results').show();
                } else {
                    $('.no-faq-results').hide();
                }
            }
        });
        
        // Search functionality (optional)
        $('#faqSearch').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();
            var visible = 0;
            
            $('.accordion-item').each(function() {
                var question = $(this).find('.accordion-button').text().toLowerCase();
                if (question.indexOf(searchTerm) > -1) {
                    $(this).show();
                    visible++;
                } else {
                    $(this).hide();
                }
            });
            
            if (visible === 0) {
                $('.no-faq-results').show();
            } else {
                $('.no-faq-results').hide();
            }
        });
    });
</script>
@endpush