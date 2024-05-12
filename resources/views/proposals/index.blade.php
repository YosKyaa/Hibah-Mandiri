@extends('layouts.master')
@section('title', 'Proposal')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>bs-stepper</h1>
        <div class="row">
            <div class="col-md-12 mt-5">
                <h2>Linear stepper</h2>
                <div id="stepper1" class="bs-stepper">
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#test-l-1">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">First step</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#test-l-2">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Second step</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#test-l-3">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Third step</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="test-l-1" class="content">
                            <p class="text-center">test 1</p>
                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                        </div>
                        <div id="test-l-2" class="content">
                            <p class="text-center">test 2</p>
                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                        </div>
                        <div id="test-l-3" class="content">
                            <p class="text-center">test 3</p>
                            <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                            <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <h2>Non linear stepper</h2>
                <div id="stepper2" class="bs-stepper">
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#test-nl-1">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">First step</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#test-nl-2">
                            <div class="btn step-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Second step</span>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#test-nl-3">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Third step</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="test-nl-1" class="content">
                            <p class="text-center">test 3</p>
                            <button class="btn btn-primary" onclick="stepper2.next()">Next</button>
                        </div>
                        <div id="test-nl-2" class="content">
                            <p class="text-center">test 4</p>
                            <button class="btn btn-primary" onclick="stepper2.next()">Next</button>
                        </div>
                        <div id="test-nl-3" class="content">
                            <p class="text-center">test 5</p>
                            <button class="btn btn-primary" onclick="stepper2.next()">Next</button>
                            <button class="btn btn-primary" onclick="stepper2.previous()">Previous</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <h2>Vertical stepper</h2>
                <div id="stepper3" class="bs-stepper vertical">
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#test-lv-1">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">First step</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#test-lv-2">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Second step</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#test-lv-3">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Third step</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="test-lv-1" class="content">
                            <p class="text-center">test 3</p>
                            <button class="btn btn-primary" onclick="stepper3.next()">Next</button>
                            <button class="btn btn-primary" onclick="stepper3.previous()">Previous</button>
                        </div>
                        <div id="test-lv-2" class="content">
                            <p class="text-center">test 4</p>
                            <button class="btn btn-primary" onclick="stepper3.next()">Next</button>
                            <button class="btn btn-primary" onclick="stepper3.previous()">Previous</button>
                        </div>
                        <div id="test-lv-3" class="content">
                            <p class="text-center">test 5</p>
                            <button class="btn btn-primary" onclick="stepper3.next()">Next</button>
                            <button class="btn btn-primary" onclick="stepper3.previous()">Previous</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <h2>Linear vertical stepper without fade</h2>
                <div id="stepper4" class="bs-stepper vertical">
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#test-vlnf-1">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">First step</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#test-vlnf-2">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Second step</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#test-vlnf-3">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Third step</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="test-vlnf-1" class="content">
                            <p class="text-center">test 1</p>
                            <button class="btn btn-primary" onclick="stepper4.next()">Next</button>
                        </div>
                        <div id="test-vlnf-2" class="content">
                            <p class="text-center">test 2</p>
                            <button class="btn btn-primary" onclick="stepper4.next()">Next</button>
                            <button class="btn btn-primary" onclick="stepper4.previous()">Previous</button>
                        </div>
                        <div id="test-vlnf-3" class="content">
                            <p class="text-center">test 3</p>
                            <button class="btn btn-primary" onclick="stepper4.next()">Next</button>
                            <button class="btn btn-primary" onclick="stepper4.previous()">Previous</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script>
        var stepper1Node = document.querySelector('#stepper1')
        var stepper1 = new Stepper(document.querySelector('#stepper1'))

        stepper1Node.addEventListener('show.bs-stepper', function(event) {
            console.warn('show.bs-stepper', event)
        })
        stepper1Node.addEventListener('shown.bs-stepper', function(event) {
            console.warn('shown.bs-stepper', event)
        })

        var stepper2 = new Stepper(document.querySelector('#stepper2'), {
            linear: false,
            animation: true
        })
        var stepper3 = new Stepper(document.querySelector('#stepper3'), {
            animation: true
        })
        var stepper4 = new Stepper(document.querySelector('#stepper4'))
    </script>
@endsection
