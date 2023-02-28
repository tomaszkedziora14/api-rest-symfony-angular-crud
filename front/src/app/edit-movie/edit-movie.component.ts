import { MovieService } from '../movie.service';
import { Movie } from '../movie';
import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-edit-movie',
  templateUrl: './edit-movie.component.html',
  styleUrls: ['./edit-movie.component.css']
})
export class EditMovieComponent implements OnInit {

  movie: Movie = new Movie();
  submitted = false;
  id:number;

  constructor(
    private route: ActivatedRoute,
    private movieService: MovieService,
    private router: Router) { }

  ngOnInit() {
    this.id = this.route.snapshot.params['id'];

    this.movieService.getMovie(this.id)
      .subscribe(data => {
 //       console.log(data)
        this.movie = data;
      }, error => console.log(error));
  }

  updateData(value: any) {
    let data = {
      title: value.title,
      description: value.description,
      year: value.year,
      actors: {
        firstName:value.firstName,
        lastName: value.lastName
      }
    }
  console.log(this.id);
  this.movieService.updateMovie(data, this.id)
  .subscribe(response => {
    console.log(response)
  });
}

}
