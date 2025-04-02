import { useEffect, useRef, useState } from "react";
import Navbar from "@/Components/Navbar";
import Welcome from "./HomeSection/Welcome";
import Experience from "./HomeSection/Experience";
import Skills from "./HomeSection/Skills";
import Portfolio from "./HomeSection/Portfolio";
import Education from "./HomeSection/Education";

const Home = () => {
    const welcomeRef = useRef(null);
    const experienceRef = useRef(null);
    const educationRef = useRef(null);
    const skillsRef = useRef(null);
    const portfolioRef = useRef(null);

    const [selectedIndex, setSelectedIndex] = useState(0);

    const sections = [
        "welcome",
        "experience",
        "education",
        "skills",
        "portfolio"
    ];

    useEffect(() => {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        setSelectedIndex(
                            sections.findIndex(
                                (element) => element === entry.target.id
                            )
                        );
                    }
                });
            },
            { threshold: 0.7 } // Section dianggap aktif jika 60% terlihat
        );

        // Observasi setiap div
        observer.observe(welcomeRef.current);
        observer.observe(experienceRef.current);
        observer.observe(educationRef.current);
        observer.observe(skillsRef.current);
        observer.observe(portfolioRef.current);

        return () => observer.disconnect(); // Bersihkan observer saat komponen unmount
    }, []);

    const scrollToWelcome = () => {
        welcomeRef?.current?.scrollIntoView({ behaviour: "smooth" });
    };

    const scrollToExperience = () => {
        experienceRef?.current?.scrollIntoView({ behaviour: "smooth" });
    };

    const scrollToEducation = () => {
        educationRef?.current?.scrollIntoView({ behaviour: "smooth" });
    };

    const scrollToSkills = () => {
        skillsRef?.current?.scrollIntoView({ behavior: "smooth" });
    };

    const scrollToPortfolio = () => {
        portfolioRef?.current?.scrollIntoView({ behavior: "smooth" });
    };

    return (
        <div className="" style={{ backgroundColor: "#F7F5F3" }}>
            <div className="w-full flex flex-row justify-content-center floating">
                <Navbar
                    selectedIndex={selectedIndex}
                    setSelectedIndex={setSelectedIndex}
                    scrollToWelcome={scrollToWelcome}
                    scrollToExperience={scrollToExperience}
                    scrollToEducation={scrollToEducation}
                    scrollToSkills={scrollToSkills}
                    scrollToPortfolio={scrollToPortfolio}
                ></Navbar>
            </div>
            <div>
                <Welcome welcomeRef={welcomeRef}></Welcome>
                <Experience ref={experienceRef}></Experience>
                <Education educationRef={educationRef}></Education>
                <Skills skillsRef={skillsRef}></Skills>
                <Portfolio portfolioRef={portfolioRef}></Portfolio>
            </div>
        </div>
    );
};

export default Home;
