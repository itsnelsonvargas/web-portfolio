@extends('portfolio.index')

@section('title', 'Portfolio Feedback - ' . $profile->name)

@section('styles')
<style>
    .floating-review-btn {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 100;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        backdrop-filter: blur(8px);
    }
    .floating-review-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.4);
    }
    #review-modal {
        transition: opacity 0.3s ease-out;
    }
    .modal-content {
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
</style>
@endsection

@section('content')
    @parent

    <!-- Floating Review Button -->
    <button id="open-review-modal" class="floating-review-btn bg-slate-900/90 border border-slate-700/50 text-white px-6 py-3 rounded-full shadow-xl flex items-center gap-3 group focus:outline-none focus:ring-2 focus:ring-blue-500/50" aria-label="Submit a review or suggestion">
        <div class="p-2 bg-blue-600 rounded-full group-hover:bg-blue-500 transition-colors">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </div>
        <span class="font-bold tracking-wide text-sm uppercase">Feedback</span>
    </button>

    <!-- Review Modal Overlay -->
    <div id="review-modal" class="fixed inset-0 z-[110] hidden flex items-center justify-center p-4 bg-slate-950/90 backdrop-blur-md opacity-0" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="modal-content bg-slate-900 border border-slate-700/50 w-full max-w-lg rounded-3xl shadow-2xl transform scale-95 overflow-hidden">
            <!-- Modal Header -->
            <div class="p-8 border-b border-slate-800 flex justify-between items-center">
                <div>
                    <h2 id="modal-title" class="text-2xl font-black text-white tracking-tight">Portfolio Feedback</h2>
                    <p class="text-slate-400 text-sm mt-1">Help me improve by sharing your thoughts.</p>
                </div>
                <button id="close-review-modal" class="text-slate-500 hover:text-white transition-colors p-2 rounded-xl hover:bg-slate-800" aria-label="Close modal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Success Message -->
            <div id="review-success-message" class="mx-8 mt-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold text-center rounded-2xl {{ session('success') || request()->query('success') ? '' : 'hidden' }}">
                {{ session('success') ?: 'Thank you for your suggestion!' }}
            </div>

            <!-- Modal Body -->
            <form action="https://formspree.io/f/mvgwedvb" method="POST" class="p-8 space-y-6">
                <input type="hidden" name="_subject" value="New Portfolio Suggestion">
                <input type="hidden" name="_next" value="{{ url()->current() }}?success=true">
                <div class="space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="review-name" class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Name <span class="text-slate-600">(Optional)</span></label>
                            <input type="text" id="review-name" name="name" class="w-full bg-slate-950/50 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-0 transition-all placeholder:text-slate-700" placeholder="John Doe">
                        </div>
                        <div>
                            <label for="review-email" class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Email <span class="text-slate-600">(Optional)</span></label>
                            <input type="email" id="review-email" name="email" class="w-full bg-slate-950/50 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-0 transition-all placeholder:text-slate-700" placeholder="john@example.com">
                        </div>
                    </div>
                    <div>
                        <label for="review-suggestion" class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Suggestion / Feedback</label>
                        <textarea id="review-suggestion" name="suggestion" rows="4" required class="w-full bg-slate-950/50 border border-slate-800 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-0 transition-all resize-none placeholder:text-slate-700" placeholder="What can I improve on this project?"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Overall Rating</label>
                        <div class="flex gap-3">
                            @foreach(range(1, 5) as $i)
                            <label class="cursor-pointer flex-1">
                                <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer">
                                <div class="h-12 flex items-center justify-center rounded-xl border border-slate-800 text-slate-500 peer-checked:bg-blue-600 peer-checked:border-blue-500 peer-checked:text-white transition-all hover:border-slate-600 font-bold">
                                    {{ $i }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-600/20 transform active:scale-[0.98] transition-all tracking-widest uppercase text-sm flex items-center justify-center gap-2 group">
                    <span>Send Feedback</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('review-modal');
        const modalContent = modal.querySelector('.modal-content');
        const openBtn = document.getElementById('open-review-modal');
        const closeBtn = document.getElementById('close-review-modal');

        const toggleModal = (show) => {
            if (show) {
                modal.classList.remove('hidden');
                // Trigger reflow
                modal.offsetHeight;
                modal.classList.add('opacity-100');
                modal.classList.remove('opacity-0');
                modalContent.classList.add('scale-100');
                modalContent.classList.remove('scale-95');
                document.body.style.overflow = 'hidden';
            } else {
                modal.classList.add('opacity-0');
                modal.classList.remove('opacity-100');
                modalContent.classList.add('scale-95');
                modalContent.classList.remove('scale-100');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
            }
        };

        openBtn.addEventListener('click', () => toggleModal(true));
        closeBtn.addEventListener('click', () => toggleModal(false));
        
        // Close on backdrop click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) toggleModal(false);
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                toggleModal(false);
            }
        });

        // If there's a success session or query parameter, show the modal
        @if(session('success') || request()->query('success'))
            toggleModal(true);
        @endif
    });
</script>
@endsection
