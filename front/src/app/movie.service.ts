import { Injectable } from '@angular/core';
import { Movie } from './movie';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';
const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' , 'Access-Control-Allow-Origin': '*'})
};

@Injectable({
  providedIn: 'root'
})
export class MovieService {

  public baseUrl = 'http://localhost:8098/api2/movies';

  constructor(private http: HttpClient) { }

  getMovies (): Observable<Movie[]> {
    return this.http.get<Movie[]>(this.baseUrl)
  }

  getMovie(id: number): Observable<any> {
    return this.http.get(`http://localhost:8098/api2/movie/${id}`);
  }

  creatMovie(Movie: any): Observable<Object> {
    return this.http.post('http://localhost:8098/api2/create', Movie);
  }

  updateMovie(Movie: any, id: number): Observable<Object> {
    return this.http.post(`http://localhost:8098/api2/update/${id}`, Movie);
  }

  deleteMovie(id: string): Observable<any> {
    return this.http.delete(`http://localhost:8098/api2/delete/${id}`);
  }

}
