const Welcome = ({welcomeRef})=>{

    return (
        <div id="welcome" ref={welcomeRef} className="">

            <div className="welcome">

                <div className="welcome-text">
                    <h1>WELCOME</h1>
                    <p className="font-semibold text-sm md:text-2xl">MY NAME IS BELINDA. CURRENTLY STUDYING AT
                    CIPUTRA UNIVERSITY. HAVE EXPERIENCE IN MAKING
                    WEBSITE WITH HTML, CSS, PHP, AND LARAVEL.</p>
                </div>
                <div>
                    <div className="contact">
                        <div className="flex align-items-center">
                            <div>
                                <img src="/porto/Phone.svg"/>
                            </div>
                            <p>+62 852 8356 7469</p>
                        </div>
                        <div className="flex align-items-center">
                            <div>
                                <img src="/porto/Mail.svg"/>
                            </div>
                            <p>
                                poetribelinda@gmail.com
                            </p>
                        </div>
                        <div className="flex align-items-center">
                            <div>
                                <img src="/porto/Loc.svg"/>
                            </div>
                            <p>Tangerang</p>
                        </div>
                    </div>
                </div>
            </div>
            <div className="w-full">
                <div className="me">
                    <img src="/porto/Me.svg"/>
                </div>
            </div>

        </div>
    )
}

export default Welcome
