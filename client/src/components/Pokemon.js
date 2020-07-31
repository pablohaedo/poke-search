import React, { Component } from 'react';
import {Card} from 'react-bootstrap'
import '../css/Pokemon.css'

class Pokemon extends Component {
    _isMounted = false;

    state = {
        loaded: false,
      };

      componentDidUpdate(prevProps){
        this._isMounted = true;
        if (this.props.name !== prevProps.name) {
            console.log(this.props)
            let { name } = this.props
            fetch(process.env.API_URL + name)
                .then(res => res.json())
                .then((response) => {
                    if (this._isMounted) {
                        this.setState( { 
                            imgUrl: response.sprites ? response.sprites.front_default ?? '/img/questionMark.png' : '/img/questionMark.png',
                        });
                    }
                })
                .catch((error)=> {
                    console.log(error);
                });
        }
    }
    componentWillUnmount() {
        this.setState( {imgUrl: null})
        this._isMounted = false;
    }

    render() {
        let { name, index } = this.props;
        return (
            <div className="col-md-6 col-lg-4 col-xl-3 py-2">
                <Card className='card h-100' key={index}>

                    <Card.Img variant="top" src={this.state.imgUrl} />
                    <Card.Body>
                        <Card.Title>{name}</Card.Title>
                    </Card.Body>
                </Card>
            </div>
        )
    }
}

export default Pokemon