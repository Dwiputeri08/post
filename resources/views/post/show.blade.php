@extends('layouts.app')

@section('title','Data Post')
@section('content') 


<div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                      <div class="card-body">
                        
                         <ul>
                            <li><label class="font-weight-bold">GAMBAR</label><img src="{{ asset('/storage/post/'.$post->image) }}"></li>
                         </ul>
                         <ul>
                            <li><label class="font-weight-bold">JUDUL : {{ $post->title }}</label></li>
                        </ul>
                        <ul>
                            <li><label class="font-weight-bold">KONTEN : {{ $post->content }}</label></li>
                        </ul>
                        <ul>
                            <li><label class="font-weight-bold">TANGGAL POSTING : {{ $post->created_at }}</label> </li>
                        </ul>
                        @include('post.komentar.show-komentar')
                        <div class="mt-4">
                            <form action ="{{url('/posts/comment/store')}}" method="POST">
                                @csrf
                                <input type= "hidden" name="post_id" id="post_id"
                                value="{{ $post->id}}">
                            <div class="form-group">
                                <label class="font-weight-bold">Komentar</label>
                                <input type="text" class="form-control
                                    @error('komentar')
                                    is-invalid @enderror"
                                    name="komentar"
                                    placeholder="Masukkan komentar post">
                                    
                                @error('komentar')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    
                                @enderror
                            </div>
                            <div>
                                 <button type="submit" class="btn btn-md btn-primary mb-4">SIMPAN</button>
                            </div>
                            </form>
                        </div>


                      
                   

                        <!-- type="submit" class="btn btn-md btn-primary">BACK</button>-->
                        <a href="{{ url('posts') }}" class="btn btn-danger btn-sm">BACK</a>
                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
 @endsection