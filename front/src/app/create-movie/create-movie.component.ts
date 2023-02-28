import { MovieService } from '../movie.service';
import { Movie } from '../movie';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-create-movie',
  templateUrl: './create-movie.component.html',
  styleUrls: ['./create-movie.component.css']
})

export class CreateMovieComponent implements OnInit {

  movie: Movie = new Movie();
  submitted = false;

  constructor(
    public movieService: MovieService,
    private router: Router) { }

    ngOnInit() {
    }

    submitData(value: any) {
      let data = {
        title: value.title,
        description: value.description,
        year: value.year,
        actors: {
          firstName:value.firstName,
          lastName: value.lastName
        }
      }
    console.log(data);
    this.movieService.creatMovie(data)
    .subscribe(response => {
      console.log(response)
    });
  }

}
