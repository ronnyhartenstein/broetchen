import React, {Component} from 'react';
import {Nav, NavItem} from 'react-bootstrap';

class Header extends Component {

    render() {
        return (
            <div className='container'>
                <div style={{margin: '0 auto'}}>
                    <img src='logo-broetchen.png' className={'img-responsive'} style={{maxHeight: '300px'}}/>
                    <Nav bsStyle='pills'>
                        <NavItem style={{backgroundColor:'red'}} href='#/'><span style={{color:'white'}}>Abonnierte Dienste</span></NavItem>
                        <NavItem style={{backgroundColor:'yellow'}} href='#/service-provider'><span style={{color:'purple'}}>Dienstleister</span></NavItem>
                        <NavItem style={{backgroundColor:'cyan'}} href='#/orders'><span style={{color:'darkblue'}}>Bestellungsliste</span></NavItem>
                        <NavItem style={{backgroundColor:'purple'}} href='#/user-profile'><span style={{color:'white'}}>Anmeldedaten</span></NavItem>
                    </Nav>
                </div>
            </div>
        );
    }

}

export default Header;