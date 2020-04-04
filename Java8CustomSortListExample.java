import java.util.Comparator;
import java.util.List;
import java.util.ArrayList;
import java.util.Arrays;

public class MyClass {
	// main
	public static void main(String args[]) {
		List<Movie> movies = Arrays.asList(
			new Movie("Lord of the rings", 8.8),
			new Movie("Back to the future", 8.5),
			new Movie("Paul, Apostle of Christ", 10.0),
			new Movie("The Passion of the Christ", 10.0)
		);

		movies.sort(Comparator.comparingDouble(Movie::getRating)/*.reversed()*/);
		System.out.println(movies.get(0).toString());
		System.out.println("");
		
		movies.forEach(System.out::println);
	}
	
	// sub classe
	public static class Movie {
		private String name;
		private Double rating;
		
		public Movie(String name, Double rating) {
			this.name = name;
			this.rating = rating;
		}
		
		public String getName() {return name;}
		public void setName(String name) {this.name = name;}
		public Double getRating() {return rating;}
		public void setRating(Double rating) {this.rating = rating;}
		
		@Override
		public String toString() {
			return "Nome: " + name + " - " + String.valueOf(rating);
		}
	}
}
