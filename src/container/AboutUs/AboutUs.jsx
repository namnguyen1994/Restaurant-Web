import React from 'react';

import { images } from '../../constants';
import './AboutUs.css';

const AboutUs = () => (
  <div className="app__aboutus app__bg flex__center section__padding" id="about">
    <div className="app__aboutus-overlay flex__center">
      <img src={images.Y} alt="y letter" />
    </div>

    <div className="app__aboutus-content flex__center">
      <div className="app__aboutus-content_about">
        <h1 className= "headtext__cormorant">About Us</h1>
        <img src={images.spoon} alt="about_spoon" className="spoon__img" />
        <p className="p__opensans"> Cooking is an art itself. It’s something that shines more beautifully as you hone it.</p>
        <button type="button" className="custom__button"> Learn More </button>
      </div>
    </div>
  </div>
);

export default AboutUs;
