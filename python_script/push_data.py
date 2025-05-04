import requests
import json

url = "http://localhost/second_project/api_testing/api.php"

data = {
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "9876543210"
}

response = requests.post(url, json=data)

print("Status Code:", response.status_code)
print("Response:", response.json())
