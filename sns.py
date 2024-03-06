import sys
import os
import boto3
from dotenv import load_dotenv

load_dotenv()
topic = os.getenv('TOPICARN')
region = os.getenv('REGION')

os.environ['AWS_SHARED_CREDENTIALS_FILE'] = '/shared/.aws/credentials'

def publish_to_sns(message):
    # Create an SNS client
    sns = boto3.client('sns', region_name=region)

    # Publish a message to the SNS topic
    topic_arn = topic
    response = sns.publish(
        TopicArn=topic_arn,
        Message=message
    )

    # Print the message ID if successful
    print("Message published with ID:", response['MessageId'])

if __name__ == "__main__":
    # Check if the number of arguments is correct
    if len(sys.argv) != 2:
        print("Usage: python script.py 'your message'")
        sys.exit(1)

    message = sys.argv[1]
    publish_to_sns(message)
