import React, { useState } from "react";
import { useTranslation } from "react-i18next";
import { clients } from "../../data/data";
import { Helmet } from "react-helmet";
import HeaderSection from "../../components/HeaderSection";
import Card from "../../components/Clients/Card";
import Button from "../../components/Button";
import ContactUs from "../../components/ContactUsSection/ContactUs";

function Clients() {
  const { t } = useTranslation();
  const [Visible, setVisible] = useState(12);
  const showMoreItems = () => {
    setVisible((prevValue) => prevValue + 4);
  };
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
    <div>
      <Helmet>
        <title>khardl clients</title>
        <meta name="description" content="khardl clients" />
      </Helmet>

      <div className="pt-[80px]">
        <div className="p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px]">
          <HeaderSection title={t("Clients")} details="" />
        </div>
        <div className="mx-[160px] max-[1250px]:mx-[20px] my-16 max-sm:my-2 max-sm:mb-12">
          <div className="grid max-sm:grid-cols-2 max-sm:gap-4 max-lg:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10 mx-4 max-sm:mx-0 mt-8 mb-[50px] max-sm:mb-[25px]">
            {clients.slice(0, Visible).map((client, index) => (
              <Card
                key={index}
                ClientImage={client.client_image}
                ClientLink={client.client_link}
              />
            ))}
          </div>
          {clients.slice(0, Visible).length === clients.length ? (
            <div></div>
          ) : (
            <div
              className="flex flex-col items-center justify-center"
              data-aos="fade-up"
              data-aos-delay="400"
            >
              <Button
                title={t("More")}
                classContainer="!border-none !px-12 max-sm:!px-8 max-sm:!text-[16px] max-sm:!py-[8px]"
                onClick={showMoreItems}
              />
            </div>
          )}
        </div>
        <ContactUs />
      </div>
    </div>
  );
}

export default Clients;
