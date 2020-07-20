import React from 'react';
import ReactDOM from 'react-dom';
import QuotingContainer from '../pages/QuotingContainer';

function Index() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">                   
                    <QuotingContainer/>
                </div>
            </div>
        </div>
    );
}

export default Index;

if (document.getElementById('root')) {
    ReactDOM.render(<Index />, document.getElementById('root'));
}
