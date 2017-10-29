import React, {Component} from 'react';
import {Button, ButtonGroup, Col, Form, FormControl, FormGroup, Table} from 'react-bootstrap';

import api from '../Api/api';
import fetch from 'isomorphic-fetch';

class PlaceServiceOrder extends Component {

    constructor(props) {
        super(props);
        this.state = {
            // TODO: fetch from backend
            service: {
                id: 1,
                name: 'Raphaels Brötchendienst',
                description: 'Brötchenlieferdienst',
                products: [
                    {
                        id: 1,
                        name: 'Vollkornbrot',
                        price: 2.1,
                        count: 1,
                    },
                    {
                        id: 2,
                        name: 'Schrippen',
                        price: 0.2,
                        count: 2,
                    },
                ]
            },
            ordersByProducts: {}
        };
    }

    handleChangeOrder(prod, e) {
        const orders = Object.assign({}, this.state.ordersByProducts);
        orders[prod.id] = {
            service: {
                id: this.state.service.id,
                name: this.state.service.name,
            },
            amount: parseInt(e.target.value)
        };
        this.setState({ordersByProducts: orders});
    }


    handleSave() {
        fetch(api.baseUrl + '/orders',
            {
                method: 'post',
                body: JSON.stringify({
                    sessionid: '4406a33260d8956e2d95fae136a5ea74',
                    orders: Object.values(this.state.ordersByProducts)
                })
            });
    }

    render() {
        return (
            <div>
                <h3>{this.state.service.name}</h3>
                <p>{this.state.service.description}</p>
                <h4>Bestellung</h4>
                <Form horizontal>
                    <FormGroup>
                        <Col sm={2}>
                            Datum
                        </Col>
                        <Col sm={10}>
                            <input type='date'/>
                        </Col>
                    </FormGroup>
                    <FormGroup>
                        <Col sm={2}>
                            Lieferart
                        </Col>
                        <Col sm={10}>
                            <ButtonGroup>
                                <Button>Klingeln</Button>
                                <Button>An die Tür hängen</Button>
                            </ButtonGroup>
                        </Col>
                    </FormGroup>
                </Form>
                <Table striped bordered>
                    <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Einzelpreis</th>
                        <th>Anzahl</th>
                        <th>Preis</th>
                    </tr>
                    </thead>
                    <tbody>
                    {
                        this.state.service.products.map(prod => {
                            const orders = this.state.ordersByProducts[prod.id];
                            return <tr key={prod.id}>
                                <td>{prod.name}</td>
                                <td>{prod.price}</td>
                                <td><FormControl type='text' value={orders && orders.amount}
                                                 onChange={this.handleChangeOrder.bind(this, prod)}/></td>
                                <td>0€</td>
                            </tr>
                        })
                    }
                    <tr>
                        <td colSpan={4}><Button bsStyle='primary'
                                                onClick={this.handleSave.bind(this)}>Bestellen</Button></td>
                    </tr>
                    </tbody>
                </Table>
            </div>
        );
    }

}

export default PlaceServiceOrder;