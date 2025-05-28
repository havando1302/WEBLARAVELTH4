@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">🔔 Thông báo của bạn</h1>

        @if($notifications->isEmpty())
            <div class="text-gray-500">Bạn không có thông báo nào.</div>
        @else
            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="p-4 rounded-lg border shadow-sm {{ $notification->read_at ? 'bg-white' : 'bg-yellow-50' }}">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold">
                                    {{ $notification->data['title'] ?? 'Thông báo' }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $notification->data['message'] ?? 'Bạn có thông báo mới.' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @if(is_null($notification->read_at))
                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-blue-500 text-sm hover:underline">
                                        Đánh dấu đã đọc
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
