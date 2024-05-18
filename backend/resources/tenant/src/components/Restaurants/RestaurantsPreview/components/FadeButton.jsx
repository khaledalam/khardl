import React, { useState, useEffect } from "react";
import { TbCircleArrowDown } from "react-icons/tb";

const FadeButton = () => {
  const [opacity, setOpacity] = useState(1);

  useEffect(() => {
    const scrollableDiv = document.getElementById("scrollableDiv");

    const handleScroll = () => {
      const maxDocumentHeight =
        scrollableDiv.scrollHeight - scrollableDiv.clientHeight;
      const currentScroll = scrollableDiv.scrollTop;
      const newOpacity = 1 - currentScroll / maxDocumentHeight;
      setOpacity(newOpacity);
    };

    scrollableDiv.addEventListener("scroll", handleScroll);

    return () => {
      scrollableDiv.removeEventListener("scroll", handleScroll);
    };
  }, []);

  return (
    <div
      className="sticky -bottom-1 rounded-xl mx-auto w-fit animate-wiggle"
      style={{ opacity: opacity }}
    >
      <TbCircleArrowDown className="rounded-xl w-10 h-10 text-blue-300" />
    </div>
  );
};

export default FadeButton;
