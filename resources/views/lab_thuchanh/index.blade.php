@extends('layout')

@section('content')
<div class="lab-container">
    <div class="lab-header">
        <h1 class="lab-title">Lab thực hành WEB</h1>
        
    </div>

    <div class="lab-grid">
        @for ($i = 1; $i <= 9; $i++)
            <a href="{{ route('lab.show', ['lab_id' => $i]) }}" class="lab-card">
                <div class="card-content">
                    <div class="icon-wrapper">
                        <span class="material-symbols-outlined">code_blocks</span>
                    </div>
                    <div class="text-content">
                        <h3 class="week-title">Lab {{ $i }}</h3>
                        <p class="week-desc">Bài tập thực hành và hướng dẫn chi tiết.</p>
                    </div>
                </div>
                <div class="card-action">
                    <span>Bắt đầu ngay</span>
                    <span class="material-symbols-outlined arrow-icon">arrow_forward</span>
                </div>
                <div class="card-bg-decoration"></div>
            </a>
        @endfor
    </div>
</div>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-bg: #ffffff;
        --text-main: #2d3748;
        --text-sub: #718096;
        --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .lab-container {
        padding: 60px 20px;
        background-color: #f8f9fa;
        min-height: calc(100vh - 200px); /* Adjust based on header/footer */
        background-image: 
            radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
            radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
            radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
        background-color: #f3f4f6;
        background-image: radial-gradient(circle at 10% 20%, rgb(242, 246, 252) 0%, rgb(242, 246, 252) 90.2%);
    }

    .lab-header {
        text-align: center;
        margin-bottom: 60px;
        animation: fadeInDown 0.8s ease-out;
    }

    .lab-title {
        font-family: 'Manrope', sans-serif;
        font-size: 3rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
        letter-spacing: -1px;
    }

    .lab-subtitle {
        font-size: 1.1rem;
        color: var(--text-sub);
        font-weight: 500;
    }

    .lab-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding-bottom: 40px;
    }

    .lab-card {
        position: relative;
        background: var(--card-bg);
        border-radius: 20px;
        padding: 30px;
        text-decoration: none;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 220px;
        animation: fadeInUp 0.6s ease-out backwards;
    }

    /* Staggered animation setup would range 1-10, simplified here */
    @for ($i = 1; $i <= 10; $i++)
        .lab-card:nth-child({{ $i }}) {
            animation-delay: {{ $i * 0.1 }}s;
        }
    @endfor

    .lab-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--hover-shadow);
    }

    .card-content {
        z-index: 2;
    }

    .icon-wrapper {
        width: 50px;
        height: 50px;
        background: #ebf4ff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: #4299e1;
        transition: all 0.3s ease;
    }

    .lab-card:hover .icon-wrapper {
        background: var(--primary-gradient);
        color: white;
        transform: scale(1.1) rotate(5deg);
    }

    .week-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 8px;
        font-family: 'Manrope', sans-serif;
    }

    .week-desc {
        font-size: 0.9rem;
        color: var(--text-sub);
        line-height: 1.5;
    }

    .card-action {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #edf2f7;
        color: #4c51bf;
        font-weight: 600;
        font-size: 0.95rem;
        z-index: 2;
    }

    .arrow-icon {
        transition: transform 0.3s ease;
    }

    .lab-card:hover .arrow-icon {
        transform: translateX(5px);
    }

    .card-bg-decoration {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: var(--primary-gradient);
        opacity: 0.05;
        border-radius: 50%;
        transition: all 0.5s ease;
        z-index: 1;
    }

    .lab-card:hover .card-bg-decoration {
        transform: scale(1.5);
        opacity: 0.1;
    }

    /* Keyframes */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .lab-title { font-size: 2rem; }
        .lab-grid { grid-template-columns: 1fr; }
        .lab-card { height: auto; }
    }
</style>
@endsection
