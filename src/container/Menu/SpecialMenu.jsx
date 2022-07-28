import React from 'react';

import { SubHeading, MenuItem } from '../../components';
import { images, data } from '../../constants';
import './SpecialMenu.css';

const SpecialMenu = () => (
  <div className="app__specialMenu flex__center section__padding" id="menu">
    <div className="app__specialMenu-title">
      <SubHeading title= "Menu that worthy of God-tongue Palatte" />
      <h1 className="headtext__cormorant">Today's Special</h1>
    </div>
    
    <div className="app__specialMenu-menu">
      <div className="app__specialMenu-menu_rices flex__center">
        <p className="app__specialMenu-menu_heading"> Rices </p>
        <div className="app__specialMenu_menu_items">
          {data.rices.map((rice, index) => (
            <MenuItem key={rice.title + index} title={rice.title} price={rice.price} tags={rice.tags}/>
          ))}
        </div>
      </div>

      <div className="app__specialMenu-menu_img">
        <img src={images.menu} alt="menu img" />
      </div>

      <div className="app__specialMenu-menu_noodles flex__center">
        <p className="app__specialMenu-menu_heading"> Noodles </p>
        <div className="app__specialMenu_menu_items">
          {data.noodles.map((noodle, index) => (
            <MenuItem key={noodle.title + index} title={noodle.title} price={noodle.price} tags={noodle.tags}/>
          ))}
        </div>
      </div>

    </div>

    <div style={{marginTop: '15px'}}>
      <button type="button" className="custom__button"> View More </button>
    </div>
  </div>
);

export default SpecialMenu;
