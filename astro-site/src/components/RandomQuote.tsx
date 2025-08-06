import React, { useEffect, useState } from 'react';

const RandomQuote = () => {
  const [quote, setQuote] = useState('');

  useEffect(() => {
    fetch('/api/quote.json')
      .then(res => res.json())
      .then(data => setQuote(data.quote));
  }, []);

  return <blockquote>{quote}</blockquote>;
};

export default RandomQuote;
