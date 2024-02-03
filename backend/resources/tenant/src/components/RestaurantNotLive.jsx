import React, { lazy, Suspense } from 'react';
import { Helmet } from 'react-helmet';
import { useTranslation } from 'react-i18next'
import { Link } from "react-router-dom";
import {useSelector} from "react-redux"
import LogoPattern from '../assets/LogoPattern.webp';
import logo from "../assets/Logo.webp";
const RestaurantNotLive = () => {
  

    // window.location.href = '/dashboard';
    //
    // return;
    const { t } = useTranslation()
    const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
  return (
    <section className=" ">
      <footer className="active text-center">
        <div className="px-6 py-10 text-center md:text-right"
         >
          <div className="flex flex-col items-center justify-center gap-4">
                  
          <div style={{ height: '60vh', display: 'flex', alignItems: 'center', justifyContent: 'center',  }}>
            <div style={{ textAlign: 'center', backgroundImage: `url(${LogoPattern})`,  backgroundSize: "cover",padding: '31px 343px', position: 'relative', top:"10%"}}>
              <Helmet>
                <title>{t('Restaurant is not live')}</title>
              </Helmet>
            <h2 style={{ color: '#FF3D00' }}>{t('This restaurant is not active. Please contact the website development team.')}</h2>
              <p style={{ color: 'black' }}>{t('Restaurant is not live yet.')}</p>
              <div>
                {/* TODO @todo change dashboard to panel */}
              {isLoggedIn
                ?  <Link to='/dashboard'>
                <button style={{ color: 'black', backgroundColor: 'white', margin: '5px' }}>{t('Dashboard')}</button>
              </Link>
                : <Link to='/login-admins'>
                <button style={{ color: 'black', backgroundColor: 'white', margin: '5px' }}>{t('Go To Login Restaurant Page')}</button>
              </Link>
              }
              <Link to={url_central}>
                <button style={{ color: 'black', backgroundColor: 'white', margin: '5px' }}>{t('Main Khardl Website')}</button>
              </Link> 
              
              </div>
            </div>
          </div>
          </div>
          </div>
          </footer>
    </section>
  );
};

export default RestaurantNotLive;
