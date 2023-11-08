import React from "react";
import HeaderSection from '../../components/HeaderSection'
import { useTranslation } from "react-i18next";
import MainText from '../../components/MainText';
import ContactUs from '../../components/ContactUsSection/ContactUs';
import Card from '../../components/Clients/Card';
import { clients } from '../../data/data'

function Clients() {
  const { t } = useTranslation();
  /*  const [clients, setClients] = useState([]);
 
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
     ///////////////////////////////////////////////////////////////////////////////////// */
  return (
    <div className='pt-[80px]'>
      <div className='p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
        <HeaderSection title={t("Clients")} details={`${t("Home")} / ${t("Clients")}`} />
      </div>
      <div className='mt-6'>
        <MainText SubTitle={t("Default Text")} />
      </div>
      <div className='mx-[160px] max-[1250px]:mx-[20px]'>
        <div className="grid max-sm:grid-cols-1 max-lg:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10 mx-4 mt-8 mb-[50px]">
          {clients.map((client, index) => (
            <Card
              key={index}
              ClientImage={client.client_image}
              ClientLink={client.client_link}
            />
          ))}
        </div>
      </div>
      <ContactUs />
    </div>
  )
}

export default Clients
