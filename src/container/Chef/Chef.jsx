import React from 'react';

import { SubHeading } from '../../components';
import { images } from '../../constants';
import './Chef.css';

const Chef = () => (
  <div className="app__bg app__wrapper section__padding">
    <div className="app__wrapper_img app__wrapper_img-reverse">
      <img src={images.chef} alt="chef" />
    </div>

    <div className="app__wrapper_info">
      <SubHeading title="Chef's Word" />
      <h1 className="headtext__cormorant"> My Life Long Goals </h1>

      <div className="app__chef-content">
        <div className="app__chef-content_quote">
          <img src={images.quote} alt="quote" />
          <p className="p__opensans">I just want to eat food created by all sorts of chefs and compete with them.</p>
        </div>
        <p className="p__opensans">The more people there are who make things completely different from my dish, the more fun it gets. I want to protect that kind of environment.</p>
      </div>

      <div className="app__chef-sign">
        <p> Yukihira Soma </p>
        <p className="p__opensans"> Chef and 1st Seat of Totsuki's Elite Council</p>
        <img src={images.signature} alt="signature" />
      </div>
    </div>
  </div>
);

export default Chef;
