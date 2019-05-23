@extends(config('theme.desktop') . '.layouts.main')

@if($hash && is_string($hash))
    @push('content')
        <div class="contact">
            <div class="section secondary-section">
                <div class="container">
                    <div class="span5 contact-form centered">
                        <h3>Unsubscribe for {{ decrypt($hash) }}</h3>
                        @if(session('status'))
                            <div class="alert alert-success">
                                <strong>Well done!</strong>{{ session('status') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-error">{{ session('error') }}</div>
                        @endif
                        @empty(session('status'))
                            <form action="{{ route('subscribe.destroy', ['hash' => $hash]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="control-group">
                                    <div class="controls">
                                        <button class="message-btn">Unsubscribe</button>
                                    </div>
                                </div>
                            </form>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    @endpush
@endif

