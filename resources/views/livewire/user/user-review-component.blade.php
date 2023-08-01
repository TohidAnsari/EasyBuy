<div>
    <style>
        input[type=radio] {
            display: none;
        }

        input[type=radio]+label {
            font-size: 25px;
            cursor: pointer;
        }

        label:active {
            transform: scale(0.8);
            transition: 0.4 ease-in-out;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('review'))
                    <div class="alert alert-success" role="alert"> {{ session()->get('review') }} </div>
                @endif
                <div id="tab-pane-3">
                    <div class="row">

                        <div class="col-md-8 offset-md-2 ">
                            <h4 class="mb-4">Add Review For "{{ $product->product->name }}"</h4>
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked
                                *</small>
                            <form wire:submit.prevent="addReview">
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <input type="radio" name="rating" id="star1" value="1"
                                            name="rating" wire:model="rating">
                                        <label for="star1" class="star far fa-star"></label>
                                        <input type="radio" name="rating" id="star2" value="2"
                                            name="rating" wire:model="rating">
                                        <label for="star2" class="star far fa-star"></label>
                                        <input type="radio" name="rating" id="star3" value="3"
                                            name="rating" wire:model="rating">
                                        <label for="star3" class="star far fa-star"></label>
                                        <input type="radio" name="rating" id="star4" value="4"
                                            name="rating" wire:model="rating">
                                        <label for="star4" class="star far fa-star"></label>
                                        <input type="radio" name="rating" id="star5" value="5"
                                            name="rating" wire:model="rating" checked>
                                        <label for="star5" class="star far fa-star"></label>
                                    </div>
                                    @error('rating')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control" wire:model="message" name="message"></textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Your Name *</label>
                                    <input type="text" class="form-control" id="name" wire:model="name"
                                        name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Your Email *</label>
                                    <input type="email" class="form-control" id="email" wire:model="email"
                                        name="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const stars = document.getElementsByClassName('star');
        for (let i = 0; i < stars.length; i++) {
            stars[i].addEventListener('click', function() {
                let current_level = i + 1;
                // console.log(current_level);
                for (let j = 0; j < stars.length; j++) {
                    if (current_level >= j + 1) {
                        console.log(i);
                        stars[j].classList.remove('far', 'fa-star');
                        stars[j].classList.add('fa', 'fa-star', 'fill-star');
                    } else {
                        stars[j].classList.remove('fa', 'fa-star', 'fill-star');
                        stars[j].classList.add('far', 'fa-star');
                    }
                }
            });
        }
    </script>
</div>
