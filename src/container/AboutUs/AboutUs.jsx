import React from 'react';

import { images } from '../../constants';
import './AboutUs.css';

const AboutUs = () => (
  <div className="app__aboutus app__bg flex__center section__padding" id="about">
    <div className="app__aboutus-overlay flex__center">
      <img src={images.background} alt="background" />
    </div>

    <div className="app__aboutus-content flex__center">
      <div className="app__aboutus-content_about">
        <h1 className= "headtext__cormorant">About Us</h1>
        <img src={images.spoon} alt="about_spoon" className="spoon__img" />
        <p className="p__opensans"> Cooking is an art itself. It’s something that shines more beautifully as you hone it.</p>
        <button type="button" className="custom__button"> Learn More </button>
      </div>

      <div className="app__aboutus-content_knife flex__center">
        <img src={images.knife} alt="about_knife" />
      </div>

      <div className="app__aboutus-content_history">
        <h1 className= "headtext__cormorant">Our History</h1>
        <img src={images.spoon} alt="about_spoon" className="spoon__img" />
        <p className="p__opensans"> We're a special-of-a-day-restaurant, right? People come here to the Yukihira looking for dishes you'd expect from a special-of-a-day-restaurant. If you miss that element in even an eccentric dish you may have created, it won't be good enough.</p>
        <button type="button" className="custom__button"> Learn More </button>
      </div>

    </div>
  </div>
);

export default AboutUs;
