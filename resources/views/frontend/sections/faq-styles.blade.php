@push('styles')
<style>
    /* FAQ Filters */
    .faq-filters {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 40px;
    }
    .faq-filters .filter-btn {
        padding: 10px 25px;
        border: 2px solid #e5e5e5;
        background: transparent;
        border-radius: 30px;
        color: #666;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
    }
    .faq-filters .filter-btn:hover {
        border-color: #f5b81a;
        color: #f5b81a;
    }
    .faq-filters .filter-btn.active {
        background: #f5b81a;
        border-color: #f5b81a;
        color: #fff;
    }
    
    /* FAQ Page */
    .page-faqs {
        padding: 80px 0;
        background: #f8f9fa;
    }
    .page-faqs .section-title h3 {
        color: #f5b81a;
    }
    .page-faqs .section-title p {
        max-width: 600px;
        margin: 15px auto 0;
        color: #666;
    }
    
    /* FAQ Accordion */
    .faq-accordion {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }
    .faq-accordion .accordion-item {
        border: 1px solid #e5e5e5;
        border-radius: 10px !important;
        margin-bottom: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .faq-accordion .accordion-item:last-child {
        margin-bottom: 0;
    }
    .faq-accordion .accordion-item:hover {
        border-color: #f5b81a;
    }
    .faq-accordion .accordion-header {
        margin: 0;
    }
    .faq-accordion .accordion-button {
        padding: 18px 25px;
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        background: transparent;
        border: none;
        box-shadow: none;
        position: relative;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .faq-accordion .accordion-button i {
        color: #f5b81a;
        font-size: 20px;
        flex-shrink: 0;
    }
    .faq-accordion .accordion-button:not(.collapsed) {
        background: #f8f9fa;
        color: #f5b81a;
    }
    .faq-accordion .accordion-button:not(.collapsed) i {
        color: #f5b81a;
    }
    .faq-accordion .accordion-button:focus {
        box-shadow: none;
        border-color: transparent;
    }
    .faq-accordion .accordion-button::after {
        content: "\f078";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        background: none;
        width: auto;
        height: auto;
        transition: all 0.3s ease;
        color: #999;
        font-size: 14px;
        margin-left: auto;
        flex-shrink: 0;
    }
    .faq-accordion .accordion-button:not(.collapsed)::after {
        content: "\f077";
        color: #f5b81a;
        transform: none;
    }
    .faq-accordion .accordion-collapse {
        border-top: 1px solid #e5e5e5;
    }
    .faq-accordion .accordion-body {
        padding: 20px 25px;
        color: #666;
        line-height: 1.8;
    }
    .faq-accordion .accordion-body p {
        margin: 0;
    }
    
    /* FAQ CTA */
    .faq-cta {
        padding: 80px 0;
        background: #fff;
    }
    .faq-cta .cta-box {
        max-width: 700px;
        margin: 0 auto;
        padding: 60px 40px;
        background: #f8f9fa;
        border-radius: 20px;
    }
    .faq-cta .cta-icon {
        margin-bottom: 20px;
    }
    .faq-cta .cta-icon img {
        width: 60px;
        height: 60px;
    }
    .faq-cta .cta-box h2 {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }
    .faq-cta .cta-box p {
        color: #666;
        font-size: 16px;
        margin-bottom: 25px;
        line-height: 1.8;
    }
    .faq-cta .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    .faq-cta .cta-buttons .btn-default {
        padding: 12px 30px;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .faq-cta .cta-buttons .btn-default i {
        font-size: 16px;
    }
    .faq-cta .cta-buttons .btn-border {
        background: transparent;
        border: 2px solid #f5b81a;
        color: #f5b81a;
    }
    .faq-cta .cta-buttons .btn-border:hover {
        background: #f5b81a;
        color: #fff;
        border-color: #f5b81a;
    }
    
    /* No Results */
    .no-faq-results {
        display: none;
        text-align: center;
        padding: 40px 0;
    }
    .no-faq-results h3 {
        font-size: 24px;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    .no-faq-results p {
        color: #666;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .page-faqs {
            padding: 60px 0;
        }
        .faq-accordion {
            padding: 20px;
        }
        .faq-cta {
            padding: 60px 0;
        }
        .faq-cta .cta-box {
            padding: 40px 20px;
        }
    }
    @media (max-width: 576px) {
        .page-faqs {
            padding: 40px 0;
        }
        .faq-accordion {
            padding: 15px;
        }
        .faq-accordion .accordion-button {
            padding: 14px 18px;
            font-size: 15px;
        }
        .faq-accordion .accordion-body {
            padding: 15px 18px;
        }
        .faq-filters .filter-btn {
            padding: 8px 18px;
            font-size: 13px;
        }
        .faq-cta .cta-box h2 {
            font-size: 26px;
        }
        .faq-cta .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
        .faq-cta .cta-buttons .btn-default {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush