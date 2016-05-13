package model;

import com.fasterxml.jackson.annotation.JsonCreator;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;

@JsonIgnoreProperties(ignoreUnknown=true) 
public class Approval {

	/**
	 * Name of client
	 */
	@JsonProperty("lastName") private String lastName;
	
	/**
	 * First name of the client
	 */
	@JsonProperty("firstName") private String firstName;
	
	/**
	 * Approval id
	 */
	@JsonProperty("id") private String id;
	
	/**
	 * reponse of the approval value
	 */
	@JsonProperty("reponse") private String reponse;

	/**
	 * Constructor of the class Bank account FOR JSON
	 * 
	 * @param lastName
	 * @param firstName
	 * @param id
	 * @param reponse
	 */
	@JsonCreator
	public Approval(@JsonProperty("lastName")String lastName, @JsonProperty("firstName")String firstName, @JsonProperty("id")String id, @JsonProperty("reponse")String reponse) 
	{
		super();
		this.lastName = lastName;
		this.firstName = firstName;
		this.id = id;
		this.reponse = reponse;
	}


	public String getLastName() 
	{
		return lastName;
	}

	public void setLastName(String lastName) 
	{
		this.lastName = lastName;
	}

	public String getFirstName() 
	{
		return firstName;
	}

	public void setFirstName(String firstName) 
	{
		this.firstName = firstName;
	}

	public String getId() 
	{
		return id;
	}

	public void setId(String id) 
	{
		this.id = id;
	}

	public String getResponse() 
	{
		return reponse;
	}

	public void setResponse(String reponse) 
	{
		this.reponse = reponse;
	}	
}
