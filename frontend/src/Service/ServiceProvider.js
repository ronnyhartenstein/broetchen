import React, {Component} from 'react';
import {Button, Modal, Table} from 'react-bootstrap';
import {Link} from 'react-router-dom';
import ServiceEditor from './ServiceEditor';

import ApiClient from '../Api/api';
import fetch from 'isomorphic-fetch';

class ServiceProvider extends Component {

    constructor(props) {
        super(props);
        this.state = {
            services: [],
            deliveredOrders: [
                {id: 98},
                {id: 37},
                {id: 15},
            ],
            addServiceVisible: false,
        }
    }

    componentDidMount() {
        fetch(ApiClient.baseUrl + '/services').then(res => res.json().then(services => {this.setState({services})}));
    }

    handleAddService() {
        this.setState({addServiceVisible: true});
    }


    handleAddServiceClose() {
        this.setState({addServiceVisible: false});
    }

    render() {
        return (
            <div>
                <Table striped bordered>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Aktion</th>
                    </tr>
                    </thead>
                    <tbody>
                    {
                        this.state.services.map(service => {
                            return <tr key={service.id}>
                                <td>{service.name}</td>
                                <td><Link to={'/service-detail/:' + service.id}><Button>Anzeigen</Button></Link></td>
                            </tr>
                        })
                    }
                    <tr>
                        <td colSpan={2}>
                            <Button bsStyle='primary' onClick={this.handleAddService.bind(this)}>Neue Dienstleistung</Button>
                        </td>
                    </tr>
                    </tbody>
                </Table>
                {this.state.addServiceVisible ? <Modal.Dialog>
                    <Modal.Header>
                        <Modal.Title>Dienstleistung hinzufügen</Modal.Title>
                        <Modal.Body>
                            <ServiceEditor />
                        </Modal.Body>
                        <Modal.Footer>
                            <Button bsStyle='primary'>Speichern</Button>
                            <Button onClick={this.handleAddServiceClose.bind(this)}>Abbrechen</Button>
                        </Modal.Footer>
                    </Modal.Header>
                </Modal.Dialog> : null}
            </div>
        );
    }

}

export default ServiceProvider;