@extends('frontend.layouts.app')

@section('title', $legalPage->meta_title ?? ($title ?? 'Legal - Solor Solar & Renewable Energy'))
@section('meta_description', $legalPage->meta_description ?? 'Legal information including Privacy Policy, Terms & Conditions, Disclaimer, and Refund Policy')
@section('meta_keywords', $legalPage->meta_keywords ?? 'privacy policy, terms and conditions, disclaimer, refund policy, legal')

@section('content')
    <!-- Page Header -->
    @include('frontend.sections.page-header', [
        'title' => $title ?? 'Legal Information',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => $title ?? 'Legal', 'url' => null]
        ]
    ])
    
    <!-- Legal Content -->
    <div class="legal-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Legal Sidebar Navigation -->
                    @include('frontend.sections.legal-sidebar')
                </div>
                <div class="col-lg-9">
                    <!-- Legal Content Area -->
                    @include('frontend.sections.legal-content')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .legal-content {
        padding: 80px 0;
        background: #f8f9fa;
    }
    .legal-sidebar {
        position: sticky;
        top: 100px;
        background: #fff;
        border-radius: 15px;
        padding: 30px 20px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }
    .legal-sidebar h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f5b81a;
        color: #1a1a1a;
    }
    .legal-sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .legal-sidebar ul li {
        margin-bottom: 5px;
    }
    .legal-sidebar ul li a {
        display: block;
        padding: 10px 15px;
        color: #666;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    .legal-sidebar ul li a:hover,
    .legal-sidebar ul li a.active {
        background: #f5b81a;
        color: #fff;
    }
    .legal-content-area {
        background: #fff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }
    .legal-content-area h1 {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    .legal-content-area .last-updated {
        color: #999;
        font-size: 14px;
        margin-bottom: 30px;
        display: block;
    }
    .legal-content-area h2 {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin-top: 30px;
        margin-bottom: 15px;
    }
    .legal-content-area h3 {
        font-size: 20px;
        font-weight: 600;
        color: #1a1a1a;
        margin-top: 25px;
        margin-bottom: 12px;
    }
    .legal-content-area p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 15px;
    }
    .legal-content-area ul {
        margin-bottom: 20px;
        padding-left: 20px;
    }
    .legal-content-area ul li {
        color: #666;
        line-height: 1.8;
        margin-bottom: 8px;
        position: relative;
        padding-left: 20px;
    }
    .legal-content-area ul li::before {
        content: "▸";
        position: absolute;
        left: 0;
        color: #f5b81a;
        font-weight: bold;
    }
    .legal-content-area .highlight-box {
        background: #f8f9fa;
        border-left: 4px solid #f5b81a;
        padding: 20px 25px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .legal-content-area .highlight-box p {
        margin: 0;
    }
    .legal-content-area .table-of-contents {
        background: #f8f9fa;
        padding: 25px 30px;
        border-radius: 10px;
        margin: 20px 0 30px;
    }
    .legal-content-area .table-of-contents h3 {
        margin-top: 0;
    }
    .legal-content-area .table-of-contents ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .legal-content-area .table-of-contents ul li {
        padding: 5px 0;
        padding-left: 0;
    }
    .legal-content-area .table-of-contents ul li::before {
        display: none;
    }
    .legal-content-area .table-of-contents ul li a {
        color: #f5b81a;
        text-decoration: none;
    }
    .legal-content-area .table-of-contents ul li a:hover {
        text-decoration: underline;
    }
    @media (max-width: 991px) {
        .legal-sidebar {
            position: relative;
            top: 0;
            margin-bottom: 30px;
        }
        .legal-content-area {
            padding: 25px;
        }
    }
    @media (max-width: 576px) {
        .legal-content-area {
            padding: 20px;
        }
        .legal-content-area h1 {
            font-size: 26px;
        }
        .legal-content-area h2 {
            font-size: 20px;
        }
    }
    /* =========================================================
   LEGAL CONTENT AREA (dynamic)
   ========================================================= */
.legal-content-area {
    background: #fff;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    border: 1px solid #f1f1f1;
}

.legal-header {
    padding-bottom: 22px;
    margin-bottom: 28px;
    border-bottom: 2px solid #f5f5f5;
}

.legal-content-area h1 {
    font-size: 32px;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 10px;
    line-height: 1.25;
    letter-spacing: -0.5px;
}

.legal-content-area .last-updated {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    color: #999;
    font-weight: 500;
    background: #f8f9fa;
    padding: 5px 12px;
    border-radius: 20px;
}

.legal-content-area .last-updated i {
    color: #28a745;
    font-size: 12px;
}

/* =========================================================
   RICH HTML BODY
   ========================================================= */
.legal-body {
    font-size: 15px;
    line-height: 1.85;
    color: #444;
}

.legal-body > *:first-child { margin-top: 0; }
.legal-body > *:last-child  { margin-bottom: 0; }

.legal-body p {
    margin: 0 0 16px;
}

.legal-body h1,
.legal-body h2,
.legal-body h3,
.legal-body h4 {
    color: #1a1a1a;
    font-weight: 700;
    line-height: 1.35;
    margin: 28px 0 12px;
}

.legal-body h1 { font-size: 26px; }
.legal-body h2 { font-size: 22px; }
.legal-body h3 { font-size: 19px; }
.legal-body h4 { font-size: 17px; }

.legal-body strong {
    color: #1a1a1a;
    font-weight: 700;
}

.legal-body a {
    color: #28a745;
    text-decoration: underline;
    transition: color 0.2s;
}

.legal-body a:hover {
    color: #128C7E;
}

.legal-body img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin: 16px 0;
}

.legal-body ul,
.legal-body ol {
    padding-left: 22px;
    margin: 0 0 18px;
}

.legal-body li {
    margin-bottom: 8px;
    line-height: 1.75;
}

.legal-body ul li::marker {
    color: #28a745;
    font-weight: 700;
}

.legal-body blockquote {
    border-left: 4px solid #28a745;
    background: #f7fbf9;
    padding: 16px 22px;
    margin: 20px 0;
    border-radius: 8px;
    color: #555;
    font-style: italic;
    font-size: 15px;
}

.legal-body table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 14px;
    border-radius: 8px;
    overflow: hidden;
}

.legal-body table td,
.legal-body table th {
    border: 1px solid #e5e5e5;
    padding: 12px 16px;
    text-align: left;
}

.legal-body table th {
    background: #f8f9fa;
    font-weight: 700;
    color: #1a1a1a;
}

.legal-body hr {
    border: none;
    border-top: 1px solid #f0f0f0;
    margin: 28px 0;
}

.legal-body code {
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 13px;
    color: #d63384;
    font-family: 'Courier New', monospace;
}

/* =========================================================
   EMPTY STATE
   ========================================================= */
.legal-empty {
    text-align: center;
    padding: 50px 20px 40px;
}

.legal-empty .empty-icon {
    width: 90px;
    height: 90px;
    margin: 0 auto 20px;
    border-radius: 50%;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.legal-empty .empty-icon i {
    font-size: 38px;
    color: #c4c9ce;
}

.legal-empty h3 {
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 12px;
}

.legal-empty p {
    font-size: 15px;
    color: #666;
    max-width: 480px;
    margin: 0 auto 24px;
    line-height: 1.7;
}

.legal-empty .empty-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}

.legal-empty .btn-default,
.legal-empty .btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 22px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s;
}

.legal-empty .btn-default {
    background: #28a745;
    color: #fff !important;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
}

.legal-empty .btn-default:hover {
    background: #218838;
    transform: translateY(-2px);
}

.legal-empty .btn-outline {
    background: #fff;
    color: #333 !important;
    border: 1.5px solid #e5e5e5;
}

.legal-empty .btn-outline:hover {
    border-color: #28a745;
    color: #28a745 !important;
    transform: translateY(-2px);
}

/* =========================================================
   FOOTER HELP BOX
   ========================================================= */
.legal-footer {
    display: flex;
    align-items: center;
    gap: 16px;
    background: linear-gradient(135deg, #f0fdf4 0%, #e6f4ea 100%);
    border: 1px solid #d6efde;
    border-radius: 14px;
    padding: 20px 24px;
    margin-top: 36px;
    flex-wrap: wrap;
}

.legal-footer-icon {
    width: 48px;
    height: 48px;
    background: #25D366;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(37, 211, 102, 0.3);
}

.legal-footer-text {
    flex: 1;
    min-width: 200px;
}

.legal-footer-text strong {
    display: block;
    font-size: 15px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 2px;
}

.legal-footer-text span {
    font-size: 13px;
    color: #666;
}

.legal-footer .btn-default {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #28a745;
    color: #fff !important;
    padding: 11px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
    white-space: nowrap;
}

.legal-footer .btn-default:hover {
    background: #218838;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.35);
}

/* =========================================================
   RESPONSIVE
   ========================================================= */
@media (max-width: 991px) {
    .legal-content-area {
        padding: 28px;
    }

    .legal-content-area h1 {
        font-size: 26px;
    }

    .legal-body h1 { font-size: 22px; }
    .legal-body h2 { font-size: 19px; }
    .legal-body h3 { font-size: 17px; }
}

@media (max-width: 575px) {
    .legal-content-area {
        padding: 20px;
        border-radius: 12px;
    }

    .legal-content-area h1 {
        font-size: 22px;
        margin-bottom: 8px;
    }

    .legal-body {
        font-size: 14px;
        line-height: 1.75;
    }

    .legal-body h1 { font-size: 20px; }
    .legal-body h2 { font-size: 18px; }
    .legal-body h3 { font-size: 16px; }

    .legal-body table {
        font-size: 13px;
    }

    .legal-body table td,
    .legal-body table th {
        padding: 8px 10px;
    }

    .legal-empty {
        padding: 40px 12px 30px;
    }

    .legal-empty h3 { font-size: 18px; }
    .legal-empty p  { font-size: 14px; }

    .legal-footer {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }

    .legal-footer .btn-default {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush