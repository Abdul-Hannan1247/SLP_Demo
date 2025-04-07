@extends('admin.layouts.master')

@push('head')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>Find the Item Game</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush


@section('content')
    <br>
    <br>

    <div class="container">
        <h1>Listen and Select the Item</h1>
        @if ($targetItem)
            <audio src="{{ asset($targetItem->audio_instruction_path) }}" controls autoplay>
                Your browser does not support the audio element.
            </audio>
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="item-container" data-item-id="{{ $item->id }}">
                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="item-image">
                        </div>
                    </div>
                @endforeach
            </div>
            <p id="feedback" class="mt-3"></p>
        @else
            <p class="no-items">No items available for this game.</p>
        @endif
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: sans-serif;
            background-color: #e0f2f7;
            /* Light blue background (Material Design Light Blue 50) */
            /* padding-top: 60px; */
            padding-bottom: 30px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        h1 {
            color: #1976d2;
            /* Primary blue color (Material Design Blue 700) */
            margin-bottom: 25px;
            text-align: center;
        }

        audio {
            display: block;
            width: 100%;
            margin-bottom: 20px;
        }

        .item-container {
            width: 100%;
            height: 150px;
            margin-bottom: 15px;
            border: 1px solid #bbdefb;
            /* Light blue border (Material Design Blue 100) */
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            background-color: #e3f2fd;
            /* Very light blue background (Material Design Blue 50) */
            transition: transform 0.1s ease-in-out, box-shadow 0.1s ease-in-out;
        }

        .item-container:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .item-image {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        #feedback {
            margin-top: 25px;
            font-weight: bold;
            text-align: center;
            color: #2e7d32;
            /* Green for success (Material Design Green 800) */
        }

        #feedback.error {
            color: #d32f2f;
            /* Red for error (Material Design Red 700) */
        }

        .no-items {
            text-align: center;
            color: #757575;
            /* Gray for informational text (Material Design Gray 600) */
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemContainers = document.querySelectorAll('.item-container');
            const feedback = document.getElementById('feedback');
            const targetItemId = "{{ $targetItem ? $targetItem->id : null }}";
            const checkAnswerUrl = "{{ route('find_item_game.check_answer') }}"; // Using named route

            itemContainers.forEach(container => {
                container.addEventListener('click', function() {
                    const selectedItemId = this.dataset.itemId;
                    console.log('Selected Item ID:', selectedItemId);
                    console.log('Target Item ID:', targetItemId);

                    fetch(checkAnswerUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({
                                item_id: selectedItemId,
                                target_item_id: targetItemId,
                            }),
                        })
                        .then(response => {
                            console.log('Response:', response);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Data from server:', data);
                            if (data.correct) {
                                feedback.textContent = 'Correct!';
                                feedback.className = ''; // Remove error class if present
                                setTimeout(() => {
                                    window.location
                                        .reload(); // Reload to start a new round
                                }, 1500);
                            } else {
                                feedback.textContent = 'Wrong answer! Try again.';
                                feedback.className = 'error';
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            console.dir(error);
                            feedback.textContent = 'An error occurred.';
                            feedback.className = 'error';
                        });
                });
            });
        });
    </script>
@endpush
