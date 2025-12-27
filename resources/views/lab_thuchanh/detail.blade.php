@extends('layout')

@section('content')
<div class="lab-container">
    <div class="lab-header">
        <h1 class="lab-title">Chi tiết Lab {{ $lab_id }} @if($subpath) / {{ $subpath }} @endif</h1>
        <div class="header-actions">
            @if($subpath)
                <a href="{{ route('lab.show', ['lab_id' => $lab_id, 'path' => dirname($subpath) == '.' ? '' : dirname($subpath)]) }}" class="back-link">
                    <span class="material-symbols-outlined">arrow_upward</span> Lên một cấp
                </a>
            @else
                <a href="{{ route('lab') }}" class="back-link">
                    <span class="material-symbols-outlined">arrow_back</span> Quay lại danh sách
                </a>
            @endif
        </div>
    </div>

    <div class="file-list-container">
        @if(count($files) > 0)
            <div class="file-grid">
                @foreach($files as $file)
                    @if($file['is_dir'])
                        <a href="{{ route('lab.show', ['lab_id' => $lab_id, 'path' => $file['path']]) }}" class="file-card folder-card">
                            <div class="file-icon">
                                <span class="material-symbols-outlined" style="color: #ffd700;">folder</span>
                            </div>
                            <div class="file-name">{{ $file['name'] }}</div>
                        </a>
                    @else
                        <a href="{{ asset('labs/Lab' . $lab_id . '/' . ($subpath ? $subpath . '/' : '') . $file['name']) }}" target="_blank" class="file-card">
                            <div class="file-icon">
                                @if(str_contains($file['name'], '.html'))
                                    <span class="material-symbols-outlined" style="color: #e34c26;">html</span>
                                @elseif(str_contains($file['name'], '.php'))
                                    <span class="material-symbols-outlined" style="color: #777bb4;">php</span>
                                @elseif(str_contains($file['name'], '.css'))
                                    <span class="material-symbols-outlined" style="color: #264de4;">css</span>
                                @elseif(str_contains($file['name'], '.js'))
                                    <span class="material-symbols-outlined" style="color: #f7df1e;">javascript</span>
                                @elseif(str_contains($file['name'], '.png') || str_contains($file['name'], '.jpg') || str_contains($file['name'], '.jpeg'))
                                    <span class="material-symbols-outlined" style="color: #4caf50;">image</span>
                                @else
                                    <span class="material-symbols-outlined" style="color: #757575;">description</span>
                                @endif
                            </div>
                            <div class="file-name">{{ $file['name'] }}</div>
                        </a>
                    @endif
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <span class="material-symbols-outlined">folder_off</span>
                <p>Thư mục Lab này hiện đang trống.</p>
            </div>
        @endif
    </div>
</div>

<style>
    .lab-container {
        padding: 40px 20px;
        background-color: #f8f9fa;
        min-height: 80vh;
    }
    
    .lab-header {
        max-width: 1000px;
        margin: 0 auto 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 20px;
    }

    .lab-title {
        font-family: 'Manrope', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
    }

    .back-link {
        display: flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        color: #4a5568;
        font-weight: 600;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #3182ce;
    }

    .file-list-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .file-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .file-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        text-decoration: none;
        color: #4a5568;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: #bee3f8;
    }

    .file-icon span {
        font-size: 48px;
        margin-bottom: 10px;
    }

    .file-name {
        font-weight: 500;
        word-break: break-all;
        font-size: 0.95rem;
    }

    .empty-state {
        text-align: center;
        padding: 50px;
        color: #a0aec0;
    }

    .empty-state span {
        font-size: 64px;
        margin-bottom: 10px;
    }
</style>
@endsection
