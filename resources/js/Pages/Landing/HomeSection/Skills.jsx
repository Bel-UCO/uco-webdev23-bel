const Skills = () => {
    return (
        <div>
            <div>
                <h1 className="pt-6rem ml-6rem">SKILLS</h1>
            </div>
            <div className="flex flex-row pt-6rem justify-content-between ml-6rem mr-6rem pb-6rem">
                <div className="flex flex-column align-items-center justify-content-center">
                    <div className="square flex align-items-center justify-content-center">
                        <img src="/porto/html.svg" />
                    </div>
                    <h3>HTML5</h3>
                </div>
                <div className="flex flex-column align-items-center justify-content-center">
                    <div className="square flex align-items-center justify-content-center">
                        <img src="/porto/css.svg" />
                    </div>
                    <h3>CSS</h3>
                </div>
                <div className="flex flex-column align-items-center justify-content-center">
                    <div className="square flex align-items-center justify-content-center">
                        <img src="/porto/php.svg" />
                    </div>
                    <h3>PHP</h3>
                </div>
                <div className="flex flex-column align-items-center justify-content-center">
                    <div className="square flex align-items-center justify-content-center">
                        <img src="/porto/laravel.svg" />
                    </div>
                    <h3>Laravel</h3>
                </div>
            </div>
        </div>
    );
};

export default Skills;
