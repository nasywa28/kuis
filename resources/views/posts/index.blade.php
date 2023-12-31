@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Menampilkan Data Pekerjaan</h3>       
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        @can('delete posts', Post::class)
                        <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                        @endcan
                     @csrf
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                              
                                <th scope="col">JUDUL</th>
                                <th scope="col">DESKRIPSI</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($posts as $post)
                                <tr>
                                    <!-- <td class="text-center">
                                        <img src="{{ asset('/storage/posts/'.$post->image) }}" class="rounded" style="width: 150px">
                                    </td> -->
                                    <td>{{ $post->title }}</td>
                                    <td>{!! $post->deskripsi !!}</td>
                                    <td>{{ $post->status }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-secondary">SHOW</a>
                                          
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-warning">EDIT</a>
                                    @can('delete posts', Post::class)
                                    @csrf
                                            
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-success">HAPUS</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                
                              @empty
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $posts->links() }}
                          <a href="{{ route('home') }}" class="btn btn-md btn-dark mb-3">Home</a>
                           
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>
@endsection