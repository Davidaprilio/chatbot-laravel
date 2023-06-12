export default function Card({ children }) {
    return (
        <div className="card">
            <div className="card__wrapper">
                <div className="card__container">
                    {children}
                </div>
            </div>
        </div>
    )
}

import Body from "./Body";
import Header from "./Header";

Card.Body = Body;
Card.Header = Header;