import React, { Component } from 'react';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Pokemon from './components/Pokemon'
import { Button, Container} from 'react-bootstrap'


class App extends Component {
    constructor(props) {
        super(props)
        this.search = this.search.bind(this)
    }

    state = {
        pokemons: [],
        search: ''
      };
    
    

      search(event) {
        event.preventDefault()
        let keyword = document.getElementById('searchTerm').value;
        fetch(process.env.API_URL+keyword)        
            .then(res => res.json())
            .then((response) => {
                console.log(response)
                this.setState({ pokemons: response });
            })
            .catch((error)=> {
                console.log(error);
            });
      }
    
      render() {
        console.log(process.env);
        const { pokemons } = this.state;
         return (
          <Container className='container'>
            <form onSubmit={this.search}>
            <input type="text" id='searchTerm' placeholder='Ingrese el nombre a buscar' />
            <Button className='button'  type='submit' onClick={this.search}>Search</Button>
            </form>
            <div className='container'>
            <div className="row">
              {
              pokemons.length >=1 ? 
                pokemons.map((pokemon, index) => (
                    <Pokemon key={index} name={pokemon.name} url={pokemon.url} ></Pokemon>
                ))
                : 'No pokemons found'
              }
            </div>
            </div>
          </Container>
        );
      }
}

export default App;
