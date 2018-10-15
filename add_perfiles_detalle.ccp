<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="perfiles" dataSource="perfiles" errorSummator="Error" wizardCaption="Agregar/Editar Perfiles " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="add_perfiles_detalle.ccp" PathID="perfiles">
			<Components>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="perfil_id" fieldSource="perfil_id" required="False" caption="Perfil Id" wizardCaption="Perfil Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="0" PathID="perfilesperfil_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="33" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_perfil" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_perfil" caption="Nombre del perfil" required="True" PathID="perfilesnom_perfil">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="29" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="LinkedID" wizardTheme="Inline" wizardThemeType="File" PathID="perfilesLinkedID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="listbox_perfiles" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="32"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="35" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="cadena" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="perfilescadena">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="12" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="list_test_asignados" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="perfiles_detalle, test" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_test" boundColumn="test_id" textColumn="nom_test" visible="Yes" PathID="perfileslist_test_asignados">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="perfiles_detalle.perfil_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="-1" parameterSource="perfil_id" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="15" tableName="perfiles_detalle" posWidth="211" posHeight="205" posLeft="452" posTop="89"/>
						<JoinTable id="17" tableName="test" posWidth="167" posHeight="386" posLeft="739" posTop="90"/>
					</JoinTables>
					<JoinLinks>
						<JoinTable2 id="19" fieldLeft="perfiles_detalle.test_id" fieldRight="test.test_id" tableLeft="perfiles_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
					</JoinLinks>
					<Fields>
						<Field id="16" tableName="perfiles_detalle" fieldName="perfiles_detalle.*"/>
						<Field id="18" tableName="test" fieldName="nom_test"/>
					</Fields>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="11" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="list_test" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="test" boundColumn="test_id" textColumn="nom_test" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_test" visible="Yes" PathID="perfileslist_test">
					<Components/>
					<Events>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="22"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="aislado" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="'V'" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="13" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="Inline" wizardThemeType="File" PathID="perfilesButton1">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="23"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="14" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" wizardTheme="Inline" wizardThemeType="File" PathID="perfilesButton2">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="24"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" removeParameters="perfil_id;nom_perfil" PathID="perfilesButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" removeParameters="perfil_id;nom_perfil" PathID="perfilesButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" removeParameters="perfil_id;nom_perfil" PathID="perfilesButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="6" message="¿Borrar este perfil?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" removeParameters="perfil_id;nom_perfil" PathID="perfilesButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="25"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="26"/>
					</Actions>
				</Event>
				<Event name="BeforeDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="27"/>
					</Actions>
				</Event>
				<Event name="OnSubmit" type="Client">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="28"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="34"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="perfil_id" parameterSource="perfil_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="add_perfiles_detalle_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="add_perfiles_detalle.php" comment="//" codePage="utf-8" forShow="True" url="add_perfiles_detalle.php"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="36"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
