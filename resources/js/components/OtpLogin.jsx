import React, { useState } from 'react';
import axios from 'axios';

const OtpLogin = () => {
  const [mobile, setMobile] = useState('');
  const [otp, setOtp] = useState('');
  const [isOtpSent, setIsOtpSent] = useState(false);
  const [message, setMessage] = useState('');

  const handleSendOtp = async () => {
    try {
      const response = await axios.post('http://127.0.0.1:8000/send-otp', { mobile });
      setMessage(response.data.message);
      setIsOtpSent(true);
    } catch (error) {
      setMessage('Failed to send OTP');
    }
  };

  const handleVerifyOtp = async () => {
    try {
      const response = await axios.post('http://127.0.0.1:8000/verify-otp', { mobile, otp });
      setMessage(response.data.message);
      if (response.data.user) {
        // Handle user login success (store token or other login flow)
      }
    } catch (error) {
      setMessage('Invalid OTP');
    }
  };

  return (
    <div>
      <h2>OTP Login</h2>
      <input
        type="text"
        value={mobile}
        onChange={(e) => setMobile(e.target.value)}
        placeholder="Enter mobile number"
      />
      <button onClick={handleSendOtp}>Send OTP</button>

      {isOtpSent && (
        <>
          <input
            type="text"
            value={otp}
            onChange={(e) => setOtp(e.target.value)}
            placeholder="Enter OTP"
          />
          <button onClick={handleVerifyOtp}>Verify OTP</button>
        </>
      )}

      {message && <p>{message}</p>}
    </div>
  );
};

export default OtpLogin;
