import React from 'react';
import ClientSection from '../../assets/ClientSection.webp';
import "react-multi-carousel/lib/styles.css";
import Carousel from "react-multi-carousel";
import { clients } from '../../data/data';
import Card from "./Card";


const Clients = () => {
  /* 
  const [clients, setClients] = useState([]);

  /////////////////////////////////////////////////////////////////////////////////////
  // API GET REQUEST 
  const fetchData = async () => {
    try {
      const response = await fetch('https://http://127.0.0.1:8000/api/clients');
      const data = await response.json();
      setClients(data.data);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };

  useEffect(() => {
    fetchData();
  }, []);
  ///////////////////////////////////////////////////////////////////////////////////// 
  */
  const responsive = {
    superLargeDesktop: {
      breakpoint: { max: 4000, min: 1024 },
      items: 4,
      slidesToScroll: 1
    },
    LargeDesktop: {
      breakpoint: { max: 1245, min: 1024 },
      items: 3,
      slidesToScroll: 1
    },
    desktop: {
      breakpoint: { max: 1024, min: 700 },
      items: 2,
    },
    tablet: {
      breakpoint: { max: 700, min: 640 },
      items: 1,
    },
    mobile: {
      breakpoint: { max: 640, min: 350 },
      items: 1,
    },
    smallMobile: {
      breakpoint: { max: 350, min: 0 },
      items: 1,
      slidesToScroll: 1
    },
  };
  return (
    <div className="text-center"
      style={{
        backgroundImage: `url(${ClientSection})`,
        backgroundSize: "cover",
      }}>
      <div className="my-14 py-6">
        <Carousel
          responsive={responsive}
          infinite={true}
          arrows={true}
          className='!mx-0 !px-0'
          containerClass="w-[98vw] !mx-0 !px-0"
          autoPlay={true}
          autoPlaySpeed={3000}
          itemClass="px-3 cursor-grab"
        >
          {clients.slice(0, 8).map((client, index) =>
            <Card
              key={index}
              ClientImage={client.client_image}
              ClientLink={client.client_link}
            />
          )}
        </Carousel>
      </div>
    </div>
  );
};

export default Clients;
