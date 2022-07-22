import React from 'react';

import { SubHeading } from '../../components';
import { images } from '../../constants';
import './Header.css';

const Header = () => (
  <div className="app__header app__wrapper section__padding" id="home">
    <div className="app__wrapper_info">
      <SubHeading title="Happy to serve!"/>
      <h1 className="app__header-h1">The True Joy of Cooking</h1>
      <p className="p__opensans" style={{margin: '2rem 0'}}> Repeating trial and error and failing many times… it’s that process which makes the dishes shine.</p>
      <button type="button" className="custom__button"> Explore Menu </button>
    </div>

    <div className="app__wrapper_img">
      <img src={images.gotcha} alt="header img" />
    </div>
  </div>
);

export default Header;
