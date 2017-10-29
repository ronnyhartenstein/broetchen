import React, {Component} from 'react';
import {Button, Col, Grid, Row, Thumbnail} from 'react-bootstrap';
import {Link} from 'react-router-dom';

import ApiClient from '../Api/api';
import fetch from 'isomorphic-fetch';

class ServiceAboOverview extends Component {

    constructor(props) {
        super(props);
        this.state = {
            abos: [],
        };
    }

    componentDidMount() {
        fetch(ApiClient.baseUrl + '/services').then(res => res.json().then(abos => {this.setState({abos})}));
    }

    render() {
        return (
            <div>
                <Grid>
                    <Row>
                        {this.state.abos.map(abo => {
                            return (
                                <Col xs={6} md={4}>
                                    <Thumbnail key={abo.id} src={abo.teaser}>
                                        <h3>{abo.name}</h3>
                                        <p>{abo.description}</p>
                                        <Link to={'/place-order/' + abo.id}><Button>Anzeigen</Button></Link>
                                    </Thumbnail>
                                </Col>
                            )
                        })}
                    </Row>
                </Grid>
            </div>
        );
    }

}

export default ServiceAboOverview;