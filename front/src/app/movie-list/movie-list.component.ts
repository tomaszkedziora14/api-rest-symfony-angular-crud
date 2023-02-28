import { Component, OnInit } from '@angular/core';
import { Observable } from "rxjs";
import { MovieService } from "../movie.service";
import { Movie } from "../movie";
import { Router } from '@angular/router';
import { EditMovieComponent } from '../edit-movie/edit-movie.component';
@Component({
  selector: 'app-movie-list',
  templateUrl: './movie-list.component.html',
  styleUrls: ['./movie-list.component.css']
})
export class MovieListComponent implements OnInit {

  movies: Movie[];
  movie:  Movie;

  constructor(private movieService:MovieService, private router:Router) { }

  ngOnInit() {
      this.getMovies();
      console.log(this.getMovies);
  }

  getMovies(): void {
    this.movieService.getMovies().subscribe(movies => {
      this.movies = movies;
    });
  }

  deleteMovie(id:string): void {
    this.movieService.deleteMovie(id).subscribe(
      error => console.log(error)
    );
    console.log(id)
  }

  bookDetails(id: number){
    this.router.navigate(['detail', id]);
  }

  EditMovie(id: number){
    this.router.navigate(['edit', id]);
  }

}
