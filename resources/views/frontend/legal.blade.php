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
</style>
@endpush