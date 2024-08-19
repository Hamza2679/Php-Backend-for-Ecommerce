import React, { useState, useEffect } from 'react';
import './Cart.css';

const Chart = () => {
  const [cartItems, setCartItems] = useState([]);

  useEffect(() => {
    // Fetch cart items when component mounts
    fetch('http://localhost/fetch_cart.php', {
      credentials: 'include'
    })
      .then(response => response.json())
      .then(data => {
        setCartItems(data);
      })
      .catch(error => {
        console.error('Error fetching cart items:', error);
      });
  }, []);

  return (
    <div className="chart">
      <h1>Cart</h1>
      <table>
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Image</th>
          </tr>
        </thead>
        <tbody>
          {cartItems.map(item => (
            <tr key={item.cart_id}>
              <td>{item.name}</td>
              <td>${item.price}</td>
              <td>{item.description}</td>
              <td>{item.quantity}</td>
              <td><img src={item.image} alt={item.name} /></td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Chart;
